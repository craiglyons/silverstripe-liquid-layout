<?php
class LiquidLayoutPage extends Page {

	private static $description = "Renders with CMS-specified Template & Layout";

	private static $db = array(
		"TemplateFileName" => "Varchar(255)",
		"LayoutFileName" => "Varchar(255)"
	);

	public function getSettingsFields(){
		$fields = parent::getSettingsFields();

		// Provide DropdownFields for each list retrieved successfully
		// Otherwise, fall back on TextFields
		foreach(array("Template", "Layout") as $type)
		{
			$DBFieldName = $type."FileName";

			$theField = null;
			$list = $this->getThemeFileList($type);
			if($list && count($list) > 0)
			{
				$theField = DropdownField::create(
					$DBFieldName,
					$type,
					array_combine($list, $list))
					->setEmptyString("Default (Page)");

			} else {
				$theField = TextField::create(
					$DBFieldName
				);
			}

			$fields->addFieldToTab(
				"Root.Settings",
				$theField
			);
		}
		return $fields;
	}

	public function getThemeFileBase($type)
	{
		$themeFileDir = null;
		$baseDir = Director::baseFolder();

		$themeDir = SSViewer::get_theme_folder();

		if ($baseDir && $themeDir) {
			$themeFileDir = $baseDir . "/" . $themeDir . "/templates/";
			if ($type == "Layout") {
				return $themeFileDir . "Layout/";
			}
		} else {
			return null;
		}
	}


	//Attempts to retrieve list of files from conventional template & Layout dir, trimmed to exclude path & extension
	private function getThemeFileList($type = "Template")
	{
		$themeFileDir = $this->getThemeFileBase($type);
		$fileNameList = glob($themeFileDir."*.ss");
		$fileNames = array();
		foreach($fileNameList as $fileName)
		{
			$fileNames[] = preg_replace("/\\.[^.\\s]{2,3}$/", "",basename($fileName));
		}

		if(count($fileNames) > 0){
			return $fileNames;
		}
	}
}


class LiquidLayoutPage_Controller extends Page_Controller {

	public function index()
	{

		$templateFileDir = $this->getThemeFileBase("Template");
		$layoutFileDir = $this->getThemeFileBase("Layout");

		if($this->TemplateFileName && file_exists($templateFileDir.$this->TemplateFileName)) {
			$templateFN = $this->TemplateFileName;
		} else {
			$templateFN = "Page";
		}

		if($this->LayoutFileName && file_exists($layoutFileDir.$this->LayoutFileName)) {
			$layoutFN = $this->LayoutFileName;
		} else {
			$layoutFN = "Page";
		}

		return $this->renderWith(array($layoutFN, $templateFN));
	}
}