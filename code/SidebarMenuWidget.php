<?php

class SidebarMenuWidget extends Widget {

    private static $db      = array(
        "MenuRoot" => "Enum(array('Root', 'Selected Page', 'Current Page', 'Root of Current Page'))",
        "ShowAll"  => "Boolean"
    );
    private static $has_one = array(
        "RootPage" => "SiteTree"
    );

    /**
     * @var string
     */
    private static $title = "Menu Widget";

    /**
     * @var string
     */
    private static $cmsTitle = "Menu Widget";

    /**
     * @var string
     */
    private static $description = "";

    public function Title() {
        return $this->WidgetLabel;
    }

    public function Menu() {
        $pages    = null;
        $rootPage = null;
        if ($this->MenuRoot == 'Root') {
            if ($this->ShowAll) {
                $result = SiteTree::get()->filter(array("ParentID" => 0));
                foreach ($result as $page) {
                    if ($page->canView()) {
                        $visible[] = $page;
                    }
                }
                $pages = new ArrayList($visible);
            } else {
                $pages = Controller::curr()->Menu(1);
            }
        } else if ($this->MenuRoot == 'Selected Page' && $this->RootPage()) {
            $rootPage = $this->RootPage();
        } else if ($this->MenuRoot == 'Current Page') {
            $rootPage = Director::get_current_page();
        } else if ($this->MenuRoot == 'Root of Current Page') {
            $rootPage = Director::get_current_page()->Children();
            /* @var $thisPage Page */
            while ($rootPage && $rootPage->ParentID !== 0) {
                $rootPage = $rootPage->Parent();
            }
        }
        if ($rootPage) {
            $pages = $this->ShowAll ? $rootPage->AllChildren() : $rootPage->Children();
        }
        return $pages;
    }

}
