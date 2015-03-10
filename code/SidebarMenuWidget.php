<?php

class SidebarMenuWidget extends Widget {

    private static $db = array(
        "MenuRoot" => "Enum(array('Root', 'Selected Page', 'Current Page', 'Root of Current Page'))",
        "ShowAll" => "Boolean"
    );
    private static $has_one = array(
        "RootPage" => "SiteTree"
    );
    private $currentRootPage = null;
    private $currentMenuItems = null;

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab("Root.Main", $fields->dataFieldByName("WidgetName"), "Enabled");
        $fields->addFieldToTab("Root.Main", $fields->dataFieldByName("WidgetLabel"), "Enabled");
        $fields->dataFieldByName("MenuRoot")->setDescription("Select from where the menu starts.<br/>
                 <strong>Root</strong>: Show the entire page tree.<br/>
                 <strong>Selected Page</strong>: Show the children of a specific page.<br/>
                 <strong>Current Page</strong>: Show the children of the page currently being viewed.<br/>
                 <strong>Root of Current Page</strong>: Show children of the current pages top most page.<br/>");
        $fields->dataFieldByName("ShowAll")->setDescription("Show all pages, even those who are marked as not to show in menus");
        $fields->replaceField("RootPageID", $RootPageField = TreeDropdownField::Create("RootPageID", "Root Page", "SiteTree")
                ->setDescription("If <strong>MenuRoot</strong> is set to &quot;Selected Page&quot; set which page to start the menu from")
        );
        $RootPageField->displayIf("MenuRoot")->isEqualTo("Selected Page");
        $fields->fieldByName("Root.Main")->Fields()->changeFieldOrder(array("WidgetName", "WidgetLabel", "Enabled", "MenuRoot", "RootPageID", "ShowAll"));
        return $fields;
    }

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
        if (!$this->currentMenuItems) {
            if ($this->MenuRoot == 'Root') {
                if ($this->ShowAll) {
                    $result = SiteTree::get()->filter(array("ParentID" => 0));
                    foreach ($result as $page) {
                        if ($page->canView()) {
                            $visible[] = $page;
                        }
                    }
                    $this->currentMenuItems = new ArrayList($visible);
                } else {
                    $this->currentMenuItems = Controller::curr()->Menu(1);
                }
            } else {
                $rootPage = $this->RootPage();
                if ($rootPage) {
                    $this->currentMenuItems = $this->ShowAll ? $rootPage->AllChildren() : $rootPage->Children();
                }
            }
        }
        return $this->currentMenuItems;
    }

    public function RootPage() {
        if (!$this->currentRootPage) {
            $this->currentRootPage = Director::get_current_page();
            if ($this->MenuRoot == 'Selected Page' && parent::RootPage()) {
                $this->currentRootPage = parent::RootPage();
            } else if ($this->MenuRoot == 'Root of Current Page' || $this->MenuRoot == 'Root') {
                while ($this->currentRootPage->exists() && ((int) $this->currentRootPage->ParentID) !== 0) {
                    $this->currentRootPage = $this->currentRootPage->Parent();
                }
            }
        }
        return $this->currentRootPage;
    }

}
