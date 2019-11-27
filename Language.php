<?php

namespace xtomdex\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use xtomdex\countryflags\CountryFlag;

/**
 * Language widget.
 *
 * Renders languages dropdown for choosing application language.
 *
 * Excepts current application language from the list.
 *
 * @author Dmitrii Sharonov <sharonovde2@gmail.com>
 */
class Language extends Widget
{
    /**
     * Add all application languages which you are going to use here.
     *
     * @var array
     */
    public $items = [
        'ru' => [
            'name' => 'Русский',
            'countryCode' => 'ru'
        ],
        'en' => [
            'name' => 'English',
            'countryCode' => 'gb'
        ],
    ];

    public $current;
    public $others;
    public $language;

    /**
     * (@inheritdoc)
     */
    public function init()
    {
        foreach ($this->items as $language => $item){
            $this->items[$language]['imgUrl'] = CountryFlag::get($item['countryCode']);
        }

        $this->language = Yii::$app->language;
        $this->current = $this->items[$this->language];
        $this->others = $this->items;
        unset($this->others[$this->language]);

        parent::init();
    }

    /**
     * (@inheritdoc)
     */
    public function run()
    {
        $content = $this->renderDropdownLink($this->current);
        $content .= "\n" . $this->renderDropdownListItems($this->others);
        echo Html::tag('li', $content, ['class' => 'dropdown']);
    }

    protected function renderDropdownLink($item)
    {
        $linkContent = Html::img($item['imgUrl'], [
            'style' => 'display: inline-block; margin-right: 5px;',
            'height' => '10',
            'alt' => $item['name']
        ]);
        $linkContent .= "\n" . Html::tag('span', '', ['class' => 'caret']);

        return Html::a($linkContent, '#', [
            'class' => 'dropdown-toggle',
            'data-toggle' => 'dropdown'
        ]);
    }

    protected function renderDropdownListItem($language, $item)
    {
        $linkContent = Html::img($item['imgUrl'], [
            'style' => 'display: inline-block; margin-right: 5px;',
            'height' => '10',
            'alt' => $item['name']
        ]) . ' ' . $item['name'];
        $link = Html::a(
            $linkContent,
            Url::current(array_merge(Yii::$app->request->get(), ['language' => $language]))
        );
        return $link;
    }

    protected function renderDropdownListItems($items)
    {
        $array = [];

        foreach ($items as $language => $item) {
            $array[] = $this->renderDropdownListItem($language, $item);
        }

        return Html::ul($array, ['class' => 'dropdown-menu', 'role' => 'menu']);
    }
}
