var AmChartsGrap = function(chartData, graphs, options, min_graph){
    var chart;
    var inerval;
       
    this.setGraph = function(){
        //затираем старые значения
        var name_input = document.getElementById(options.writeId)
        name_input.innerHTML = '';

        // SERIAL CHART
        chart = new AmCharts.AmSerialChart();
        chart.pathToImages = "/images/";
        chart.marginTop = 21;
        chart.marginRight = 0;
        chart.dataProvider = chartData;
        chart.categoryField = "point";
        chart.zoomOutButton = {
            backgroundColor: '#000000',
            backgroundAlpha: 0.15
        };
        
        //показывает только часть графика при формировании графика
        if(options.showAllGraph == undefined || ( options.showAllGraph != undefined && options.showAllGraph == false ) )
            chart.addListener("dataUpdated", this.zoomChartGraph);

        // AXES
        // category
        var categoryAxis = chart.categoryAxis;
        categoryAxis.parseDates = false; // as our data is date-based, we set parseDates to true
        categoryAxis.dashLength = 2;
        categoryAxis.axisColor = "#DADADA";
        categoryAxis.autoGridCount = false;
        categoryAxis.gridCount = ($(window).width() < 1260)? 5 : 10;
        categoryAxis.boldPeriodBeginning = false;        

        // value
        var valueAxis = new AmCharts.ValueAxis();
        valueAxis.axisAlpha = 0.5;
        valueAxis.dashLength = 2;
        valueAxis.inside = false; //выводить шкалу внутри графика или нет
        valueAxis.autoGridCount = false;
        valueAxis.gridCount = 5;
        valueAxis.integersOnly = true;
        chart.addValueAxis(valueAxis);  

        if(graphs != undefined && graphs.length >= 1){

            for(i=0;i<graphs.length;i++){

                if(graphs[i].id == undefined || graphs[i].name == undefined)
                continue;

                //GRAPH
                var graph = new AmCharts.AmGraph();               
                graph.lineThickness = 2; //толщина самой линии                
                graph.bullet = "round";  //что бы где значения показывались точки
                graph.bulletSize = 6;  //размер точек
                graph.connect = false; // что бы были обрывы если данных нет
                graph.valueField = graphs[i].id;                 
                graph.title = graphs[i].name;

                if(graphs[i].color != undefined)                        
                        graph.lineColor = graphs[i].color; //цвет линии

                chart.addGraph(graph);
            }                    
        }

        //горизонтальная линия
        if(options.average != undefined && options.average.value != undefined){
            var guide = new AmCharts.Guide();
            guide.value = options.average.value;
            if(options.average.color != undefined);
                guide.lineColor = options.average.color;
            guide.dashLength = 7;
            if(options.average.name != undefined)
                guide.label = options.average.name;
            guide.inside = true;
            guide.lineAlpha = 1;
            valueAxis.addGuide(guide); 
        }

        // CURSOR  
        var chartCursor = new AmCharts.ChartCursor();
        chartCursor.cursorAlpha = 0.5;
        chartCursor.cursorPosition = "mouse";
       // chartCursor.valueBalloonsEnabled = false;  выключает значения при наведении
       // chartCursor.categoryBalloonEnabled = false;
       // chartCursor.categoryBalloonColor = 'red';
        chartCursor.pan = true; // set it to fals if you want the cursor to work in "select" mode
        chart.addChartCursor(chartCursor);


        // SCROLLBAR
        var chartScrollbar = new AmCharts.ChartScrollbar();
        //  chartScrollbar.graph = graph;
        chartScrollbar.scrollbarHeight = 40;
        chartScrollbar.color = "#737070";
        chartScrollbar.autoGridCount = false;
        chartScrollbar.gridCount = ($(window).width() < 1260)? 5 : 10;
        chart.addChartScrollbar(chartScrollbar);

        // LEGEND
        if(graphs.length > 1){
            var legend = new AmCharts.AmLegend();
            legend.equalWidths = false;
            legend.valueWidth = '212323';
            chart.addLegend(legend);
        }

        // WRITE
        chart.write(options.writeId);
//        $("tspan:contains('chart by amcharts.com')").hide();
//        $("tspan:contains('chart by amcharts.com')").remove();
    }
    
    this.setGraphMin = function(){
        //затираем старые значения
        var name_input = document.getElementById(options.writeId)
        name_input.innerHTML = '';

        // SERIAL CHART
        chart = new AmCharts.AmSerialChart();
        chart.pathToImages = "/images/";
        chart.marginTop = 21;
        chart.marginRight = 0;
        chart.dataProvider = chartData;
        chart.categoryField = "point";
        chart.zoomOutButton = {
            backgroundColor: '#000000',
            backgroundAlpha: 0.15
        };
                
         // AXES
        // category                
        var categoryAxis = chart.categoryAxis;
        categoryAxis.parseDates = false; // as our data is date-based, we set parseDates to true
        categoryAxis.minPeriod = "DD"; // our data is daily, so we set minPeriod to DD
        categoryAxis.inside = true;
        categoryAxis.gridAlpha = 0;
        categoryAxis.tickLength = 0;
        categoryAxis.axisAlpha = 0;
        categoryAxis.color = '#fff';
        
        // value
        var valueAxis = new AmCharts.ValueAxis();
        valueAxis.axisAlpha = 0;
        valueAxis.dashLength = 0;
        valueAxis.color = '#fff';
        valueAxis.inside = true; //выводить шкалу внутри графика или нет
        chart.addValueAxis(valueAxis);  

        if(graphs != undefined && graphs.length >= 1){

            for(i=0;i<graphs.length;i++){

                if(graphs[i].id == undefined || graphs[i].name == undefined)
                continue;

                //GRAPH
                var graph = new AmCharts.AmGraph();               
                graph.lineThickness = 2; //толщина самой линии                
                graph.bullet = "round";  //что бы где значения показывались точки
                graph.bulletSize = 8;  //размер точек
                graph.connect = false; // что бы были обрывы если данных нет
                graph.valueField = graphs[i].id;                 
                graph.title = graphs[i].name;

                if(graphs[i].color != undefined)                        
                        graph.lineColor = graphs[i].color; //цвет линии

                chart.addGraph(graph);
            }                    
        }

        // WRITE
        chart.write(options.writeId);
    }
    
    // this method is called when chart is first inited as we listen for "dataUpdated" event
    this.zoomChartGraph = function(){
        // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
        chart.zoomToIndexes(10, 20);
    }      
    
    //при инициализации строим график сразу
    if(min_graph == true)
        this.setGraphMin();
    else
        this.setGraph();
}