<?php

namespace Falkgeist\ContaoUsageBundle\BackendModules;

use Contao\BackendModule;
use Contao\Controller;
use Contao\Database;
use Contao\DataContainer;
use Contao\System;

/**
 * @author Falk von Freigeist <info@falkvonfreigeist.com>
 */
class ModuleFEModuleUsage extends BackendModule {

    /**
     * @var array
     */
    protected $module;

    /**
     * @var array
     */
    protected $usages;

    /**
     * @param DataContainer $dc
     */
    public function __construct(DataContainer $dc = null) {
        parent::__construct($dc);
    }

    /**
     * @param integer $module
     * @return void
     */
    public function setModule($module) {
        $sql = 'SELECT id, name FROM tl_module WHERE id = ?';
        $this->module = Database::getInstance()->prepare($sql)->execute($module)->row();
    }

    /**
     * @param DataContainer $dc
     * @return string
     */
    public function generateFromDC($dc) {
        $this->setModule($dc->id);
        return $this->generate();
    }

    /**
     * @see \Contao\BackendModule::generate()
     */
    public function generate() {
        if(!$this->module) {
            Controller::redirect(System::getReferer());
            return;
        }

        $this->articleUsages = self::getArticleUsages($this->module['id']);
        if(!$this->articleUsages) {
            Controller::redirect(System::getReferer());
            return;
        }

        $this->strTemplate = 'be_moduleusage';

        return parent::generate();
    }

    /**
     * @see \Contao\BackendModule::compile()
     */
    protected function compile() {
        System::loadLanguageFile('tl_article');
        Controller::loadDataContainer('tl_article');
        System::loadLanguageFile('tl_layout');
        Controller::loadDataContainer('tl_layout');

        $articleUsages = $this->articleUsages;
        $count = count($articleUsages);

        $this->Template->module = $this->module;
        $this->Template->articleUsages = $articleUsages;
        $this->Template->count = $count;
    }

    /**
     * @param integer $id
     * @return array
     */
    public static function getArticleUsages($id) {
        $usages = [];

        $sql = <<<SQL
SELECT
	a.id,
	a.title,
	a.published,
	a.start,
	a.stop
FROM
	tl_article a
JOIN
	tl_content c
ON
    a.id = c.pid
WHERE
	c.type = "module" AND
    c.module = ?
SQL;
        $articles = Database::getInstance()->prepare($sql)->execute($id);

        while($articles->next()) {
            $article = $articles->row();
            $usages[] = $article;
        }

        return $usages;
    }

    /**
     * @param integer $id
     * @return array
     */
    public static function getLayoutUsages($id) {
        $usages = [];

        $sql = <<<SQL
SELECT
	a.id,
	a.title,
	a.published,
	a.start,
	a.stop
FROM
	tl_article a
JOIN
	tl_content c
ON
    a.id = c.pid
WHERE
	c.type = "module" AND
    c.module = ?
SQL;
        $articles = Database::getInstance()->prepare($sql)->execute($id);

        while($articles->next()) {
            $article = $articles->row();
            $usages[] = $article;
        }

        return $usages;
    }
}
