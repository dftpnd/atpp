/* Copyright (c) 2009 Mustafa OZCAN (http://www.mustafaozcan.net)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 * Version: 1.0.1
 * Requires: jquery.1.3+
 */

jQuery.fn.fixedtableheader = function (options) {
    var settings = jQuery.extend({
        headerrowsize: 1,
        highlightrow: false,
        highlightclass: "highlight"
    }, options);
    this.each(function (i) {
        var $tbl = $(this);
        var $tblhfixed = $tbl.find(".tr_t:lt(" + settings.headerrowsize + ")");
        var headerelement = ".th_t";
        var footerelement = ".td_t";
        if ($tblhfixed.find(headerelement).length == 0) headerelement = ".td_t";
        if ($tblhfixed.find(headerelement).length > 0) {
            var container_width = new Object;
            $tblhfixed.find(headerelement).each(function (index) {
                var widht = $(this).width();
                $(this).css("width", widht);
                container_width[index] = widht;
                // $('.everet tr:nth-child(1) td:nth-child('+ind+')').css("width", $(this).width());
            });

            $('.everet .tr_t:nth-child(1) .td_t').each(function (index) {
                $(this).css("width", container_width[index] + 'px');
            });

            var FixedFooter = $('.footer_for_table');
            var $clonedTable = $tbl.clone().empty();
            var tblwidth = GetTblWidth($tbl);
            $clonedTable.attr("id", "fixedtableheader" + i).css({
                "position": "fixed",
                "top": "0",
                "left": $tbl.offset().left
            }).append($tblhfixed.clone()).width(tblwidth).hide().appendTo($("body"));
            if (settings.highlightrow) $("tr:gt(" + (settings.headerrowsize - 1) + ")", $tbl).hover(function () {
                $(this).addClass(settings.highlightclass);
            }, function () {
                $(this).removeClass(settings.highlightclass);
            });

            $clonedTable.width($tbl.width());
            FixedFooter.width($tbl.width());

            $(window).scroll(function () {

                $clonedTable.css({
                    "position": "fixed",
                    "top": "0",
                    "left": $tbl.offset().left - $(window).scrollLeft()
                });
                FixedFooter.css({
                    left: -$(window).scrollLeft() + 'px'
                });

                var sctop = $(window).scrollTop();
                var elmtop = $tblhfixed.offset().top;
                if (sctop > elmtop && sctop <= (elmtop + $tbl.height() - $tblhfixed.height())) $clonedTable.show(); else $clonedTable.hide();
            });
            $(window).resize(function () {
                if ($clonedTable.width() != $tbl.width()) {
                    var container_width = new Object;
                    $tblhfixed.find(headerelement).each(function (index) {
                        var w = $(this).width();
                        $(this).css("width", w);
                        $clonedTable.find(headerelement).eq(index).css("width", w);
                        container_width[index] = w;
                        // FixedFooter.find(footerelement).eq(index).css("width", w);
                    });

                    $('.everet tr:nth-child(1) td').each(function (index) {
                        $(this).css("width", container_width[index] + 'px');
                    });

                    $clonedTable.width($tbl.width());
                    FixedFooter.width($tbl.width());
                }
                $clonedTable.css("left", $tbl.offset().left);
                FixedFooter.css("left", $tbl.offset().left);
            });
        }
    });
    function GetTblWidth($tbl) {
        var tblwidth = $tbl.width();

        return tblwidth;
    }

};

