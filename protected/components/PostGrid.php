<?php

Yii::import('zii.widgets.grid.CGridView');

class PostGrid extends CGridView
{

    public function renderItems()
    {
        if ($this->dataProvider->getItemCount() > 0 || $this->showTableOnEmpty) {
            echo "<div class=\"{$this->itemsCssClass}\">\n";
            ob_start();
            $this->renderTableBody();
            $body = ob_get_clean();
            echo $body;
            echo "</div>";
        } else
            $this->renderEmptyText();
    }

    public function renderTableBody()
    {
        $data = $this->dataProvider->getData();
        $n = count($data);
        echo "<div>\n";

        if ($n > 0) {
            for ($row = 0; $row < $n; ++$row) {
                $this->render('application.views.post.one', array('data' => $data[$row]));
            }
        } else {

            $this->renderEmptyText();

        }
        echo "</div>\n";
    }
}




