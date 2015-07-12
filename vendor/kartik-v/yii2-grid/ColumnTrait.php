<?php

/**
 * @package   yii2-grid
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2015
 * @version   3.0.5
 */

namespace kartik\grid;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use \Closure;

/**
 * Trait for all column widgets in yii2-grid
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
trait ColumnTrait
{
    /**
     * Renders the header cell.
     *
     * @return string
     */
    public function renderHeaderCell()
    {
        if ($this->grid->filterModel !== null && $this->mergeHeader && $this->grid->filterPosition === GridView::FILTER_POS_BODY) {
            $this->headerOptions['rowspan'] = 2;
            Html::addCssClass($this->headerOptions, 'kv-merged-header');
        }
        $this->headerOptions['data-col-seq'] = array_search($this, $this->grid->columns);
        return parent::renderHeaderCell();
    }

    /**
     * Renders the filter cell.
     *
     * @return string
     */
    public function renderFilterCell()
    {
        if ($this->grid->filterModel !== null && $this->mergeHeader && $this->grid->filterPosition === GridView::FILTER_POS_BODY) {
            return null;
        }
        if (isset($this->filterType) && $this->filterType === GridView::FILTER_SELECT2 && empty($this->filterWidgetOptions['pluginOptions']['width'])) {
            $this->filterWidgetOptions['pluginOptions']['width'] = 'resolve';
        }
        $this->headerOptions['data-col-seq'] = array_search($this, $this->grid->columns);
        return parent::renderFilterCell();
    }

    /**
     * Renders the page summary cell.
     *
     * @return string the rendered result
     */
    public function renderPageSummaryCell()
    {
        $prepend = ArrayHelper::remove($this->pageSummaryOptions, 'prepend', '');
        $append = ArrayHelper::remove($this->pageSummaryOptions, 'append', '');
        return Html::tag('td', $prepend . $this->renderPageSummaryCellContent() . $append, $this->pageSummaryOptions);
    }

    /**
     * Renders the page summary cell content.
     *
     * @return string the rendered result
     */
    protected function renderPageSummaryCellContent()
    {
        if ($this->hidePageSummary) {
            return $this->grid->emptyCell;
        }
        $content = $this->getPageSummaryCellContent();
        if ($this->pageSummary === true) {
            return $this->grid->formatter->format($content, $this->format);
        }
        return ($content === null) ? $this->grid->emptyCell : $content;
    }

    /**
     * Gets the raw page summary cell content.
     *
     * @return string the rendered result
     */
    protected function getPageSummaryCellContent()
    {
        if ($this->pageSummary === true || $this->pageSummary instanceof \Closure) {
            $summary = $this->calculateSummary();
            return ($this->pageSummary === true) ? $summary : call_user_func(
                $this->pageSummary,
                $summary,
                $this->_rows,
                $this
            );
        }
        if ($this->pageSummary !== false) {
            return $this->pageSummary;
        }
        return null;
    }

    /**
     * Calculates the summary of an input data based on page summary aggregration function.
     *
     * @return float
     */
    protected function calculateSummary()
    {
        if (empty($this->_rows)) {
            return '';
        }
        $data = $this->_rows;
        $type = $this->pageSummaryFunc;
        switch ($type) {
            case null:
                return array_sum($data);
            case GridView::F_SUM:
                return array_sum($data);
            case GridView::F_COUNT:
                return count($data);
            case GridView::F_AVG:
                return count($data) > 0 ? array_sum($data) / count($data) : null;
            case GridView::F_MAX:
                return max($data);
            case GridView::F_MIN:
                return min($data);
        }
        return '';
    }

    /**
     * Checks if the filter input types are valid
     *
     * @return void
     */
    protected function checkValidFilters()
    {
        if (isset($this->filterType)) {
            \kartik\base\Config::validateInputWidget($this->filterType, 'for filtering the grid as per your setup');
        }
    }

    /**
     * Checks `hidden` property and hides the column from display
     *
     * @return void
     */
    protected function parseVisibility()
    {
        if ($this->hidden === true) {
            Html::addCssClass($this->filterOptions, 'kv-grid-hide');
            Html::addCssClass($this->headerOptions, 'kv-grid-hide');
            Html::addCssClass($this->footerOptions, 'kv-grid-hide');
            Html::addCssClass($this->pageSummaryOptions, 'kv-grid-hide');
        }
        if ($this->hiddenFromExport === true) {
            Html::addCssClass($this->filterOptions, 'skip-export');
            Html::addCssClass($this->headerOptions, 'skip-export');
            Html::addCssClass($this->footerOptions, 'skip-export');
            Html::addCssClass($this->pageSummaryOptions, 'skip-export');
            Html::addCssClass($this->options, 'skip-export');
        }
        if (is_array($this->hiddenFromExport) && !empty($this->hiddenFromExport)) {
            $tag = 'skip-export-';
            $css = $tag . implode(" {$tag}", $this->hiddenFromExport);
            Html::addCssClass($this->filterOptions, $css);
            Html::addCssClass($this->headerOptions, $css);
            Html::addCssClass($this->footerOptions, $css);
            Html::addCssClass($this->pageSummaryOptions, $css);
            Html::addCssClass($this->options, $css);
        }
    }

    /**
     * Parses and formats a grid column
     *
     * @return void
     */
    protected function parseFormat()
    {
        if ($this->isValidAlignment()) {
            $class = "kv-align-{$this->hAlign}";
            Html::addCssClass($this->headerOptions, $class);
            Html::addCssClass($this->pageSummaryOptions, $class);
            Html::addCssClass($this->footerOptions, $class);
        }
        if ($this->noWrap) {
            Html::addCssClass($this->headerOptions, GridView::NOWRAP);
            Html::addCssClass($this->pageSummaryOptions, GridView::NOWRAP);
            Html::addCssClass($this->footerOptions, GridView::NOWRAP);
        }
        if ($this->isValidAlignment('vAlign')) {
            $class = "kv-align-{$this->vAlign}";
            Html::addCssClass($this->headerOptions, $class);
            Html::addCssClass($this->pageSummaryOptions, $class);
            Html::addCssClass($this->footerOptions, $class);
        }
        if (trim($this->width) != '') {
            Html::addCssStyle($this->headerOptions, "width:{$this->width};");
            Html::addCssStyle($this->pageSummaryOptions, "width:{$this->width};");
            Html::addCssStyle($this->footerOptions, "width:{$this->width};");
        }
    }

    /**
     * Check if the alignment provided is valid
     *
     * @param string $type the alignment type
     *
     * @return bool
     */
    protected function isValidAlignment($type = 'hAlign')
    {
        if ($type === 'hAlign') {
            return (
                $this->hAlign === GridView::ALIGN_LEFT ||
                $this->hAlign === GridView::ALIGN_RIGHT ||
                $this->hAlign === GridView::ALIGN_CENTER
            );
        } elseif ($type = 'vAlign') {
            return (
                $this->vAlign === GridView::ALIGN_TOP ||
                $this->vAlign === GridView::ALIGN_MIDDLE ||
                $this->vAlign === GridView::ALIGN_BOTTOM
            );
        }
        return false;
    }

    /**
     * Parses and fetches updated content options for grid visibility and format
     *
     * @param mixed   $model the data model being rendered
     * @param mixed   $key the key associated with the data model
     * @param integer $index the zero-based index of the data item among the item array returned by
     *     [[GridView::dataProvider]].
     *
     * @return array
     */
    protected function fetchContentOptions($model, $key, $index)
    {
        if ($this->contentOptions instanceof \Closure) {
            $options = call_user_func($this->contentOptions, $model, $key, $index, $this);
        } else {
            $options = $this->contentOptions;
        }
        if ($this->hidden === true) {
            Html::addCssClass($options, "kv-grid-hide");
        }
        if ($this->hiddenFromExport === true) {
            Html::addCssClass($options, "skip-export");
        }
        if (is_array($this->hiddenFromExport) && !empty($this->hiddenFromExport)) {
            $tag = 'skip-export-';
            $css = $tag . implode(" {$tag}", $this->hiddenFromExport);
            Html::addCssClass($options, $css);
        }
        if ($this->isValidAlignment()) {
            Html::addCssClass($options, "kv-align-{$this->hAlign}");
        }
        if ($this->noWrap) {
            Html::addCssClass($options, GridView::NOWRAP);
        }
        if ($this->isValidAlignment('vAlign')) {
            Html::addCssClass($options, "kv-align-{$this->vAlign}");
        }
        if (trim($this->width) != '') {
            Html::addCssStyle($options, "width:{$this->width};");
        }
        $options['data-col-seq'] = array_search($this, $this->grid->columns);
        return $options;
    }

    /**
     * Store all rows for the column for the current page
     *
     * @return void
     */
    protected function setPageRows()
    {
        if (
            $this->grid->showPageSummary && isset($this->pageSummary) &&
            $this->pageSummary !== false && !is_string($this->pageSummary)
        ) {
            $provider = $this->grid->dataProvider;
            $models = array_values($provider->getModels());
            $keys = $provider->getKeys();
            foreach ($models as $index => $model) {
                $key = $keys[$index];
                $this->_rows[] = $this->getDataCellValue($model, $key, $index);
            }
        }
    }

    /**
     * Get the raw footer cell content.
     *
     * @return string the rendered result
     */
    protected function getFooterCellContent()
    {
        return $this->footer;
    }

    /**
     * Initialize column specific JS functionality whenever pjax request completes
     *
     * @param string $script the js script to be used as a callback
     *
     * @return void
     */
    protected function initPjax($script = '')
    {
        if (!$this->grid->pjax || empty($script)) {
            return;
        }
        $cont = 'jQuery("#' . $this->grid->pjaxSettings['options']['id'] . '")';
        $view = $this->grid->getView();
        $event = 'pjax:complete.' . hash('crc32', $script);
        $view->registerJs("{$cont}.off('{$event}').on('{$event}', function(){{$script}});");
    }

    /**
     * Parses a value if Closure and returns the right value
     */
    protected function parseVal($var, $model, $key, $index)
    {
        return $var instanceof Closure ? 
            call_user_func($var, $model, $key, $index, $this) : 
            $var;
    }
    
    /**
     * Initializes grid grouping
     *
     * @return void
     */
    protected function initGrouping()
    {
        if (empty($this->group)) {
            return;
        }
        $view = $this->grid->getView();
        $this->_columnKey = $this->getColumnKey();
        Html::addCssClass($this->headerOptions, 'kv-grid-group-header');
        Html::addCssClass($this->filterOptions, 'kv-grid-group-filter');
        $this->headerOptions['data-group-key'] = $this->filterOptions['data-group-key'] = $this->_columnKey;
        GridGroupAsset::register($view);
        $id = $this->grid->options['id'];
        $this->_clientScript = "kvGridGroup('{$id}');";
        $view->registerJs($this->_clientScript);
    }

    /**
     * Parses grid grouping and sets data attributes
     *
     * @return void
     */
    protected function parseGrouping(&$options, $model, $key, $index)
    {
        if (empty($this->group)) {
            return;
        }
        Html::addCssClass($options, 'kv-grid-group');
        $options['data-group-key'] = $this->_columnKey;
        if (!empty($this->groupOddCssClass)) {
            $options['data-odd-css'] = $this->parseVal($this->groupOddCssClass, $model, $key, $index);
        }
        if (!empty($this->groupEvenCssClass)) {
            $options['data-even-css'] = $this->parseVal($this->groupEvenCssClass, $model, $key, $index);
        }
        if (isset($this->subGroupOf)) {
            $options['data-sub-group-of'] = $this->parseVal($this->subGroupOf, $model, $key, $index);
        }
        if (isset($this->groupedRow)) {
            $options['data-grouped-row'] = $this->parseVal($this->groupedRow, $model, $key, $index);
        }
        if (!empty($this->groupHeader)) {
            $options['data-group-header'] = Json::encode($this->parseVal($this->groupHeader, $model, $key, $index));
        }
        if (!empty($this->groupFooter)) {
            $options['data-group-footer'] = Json::encode($this->parseVal($this->groupFooter, $model, $key, $index));
        }
    }

    /**
     * Generate an unique column key
     *
     * @return mixed
     */
    protected function getColumnKey()
    {
        if (!empty($this->attribute)) {
            $key = $this->attribute;
        } elseif (!empty($this->label)) {
            $key = $this->label;
        } elseif (!empty($this->header)) {
            $key = $this->header;
        } else {
            $key = get_class($this);
        } 
        return hash('crc32', $key);
    }
}