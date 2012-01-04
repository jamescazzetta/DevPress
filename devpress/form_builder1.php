<?php
	class Form{
		public $OriginTable			= ($GLOBALS["thetable"] ? $GLOBALS["thetable"] : 'NoTable'); //required
		public $OriginID			= ($GLOBALS["theid"] ? $GLOBALS["theid"] : 'NoOriginID'); //required
		public $SQLOrigindata		= data(array($this->OriginTable), array($this->OriginID), 1);
		
		public $ButtonLabels		= array("submit" => "Save", "cancel" => "Cancel", "delete" => FALSE, "publish" => FALSE);
		public function __construct(){
			echo '<form  method="post" class="editarea" action="?action=save&edit_id=' . $this->OriginID .'"><input type="hidden" name="id" value="' . $this->OriginID  . '">';
		}
		public function __destruct() { 
			$return = '<p>';
			$return .= '<span class="button-group">';
				$return .= $this->GetSubmitButton($ButtonLabels['submit']);
				$return .= $this->GetCancelButton($ButtonLabels['cancel']);
			$return .= '</span>';
			$return .= '</p></form>';

			echo $return;
		}
		
		public function setButtonLabels($args){
			public $ButtonLabels = $args;
		}
		
		public function setOriginTable($origintable){
			$this->$OriginTable = $origintable;
		}
		
		public function setOriginID($id){
			$this->$OriginID = $id;
		}
		
		public function getSubmitButton($label){
			return "<input type='submit' name='submit' value='$label' class='button primary submit icon approve'>";
		}
		
		public function getCancelButton($label){
			return "<a href='".$_SERVER['SCRIPT_NAME']."' class='button'>$label</a>";
		}
		
	}

	class FormElement extends Form{
		
		public $OriginCol			= ""; //required
		public $TargetTable			= $parent->OriginTable;
		public $TargetID			= $parent->OriginID;
		public $SQLTargetdata		= $parent->SQLOrigindata;
		public $TargetCol			= $this->OriginCol;
		public $PostName			= $this->TargetTable . ':' . $this->TargetCol . '::' .  $this->TargetID;
		public $InputType			= "text";
		public $ElementTitle		= $this->PostName;
		public $ElementDescritption = "";
		
		public function __construct(){
			//save data
			if ($this->isDataOld()) {
				$this->SaveData();
			}
			$this->SQLTargetdata = data(array($this->TargetTable), array($this->TargetID), 1);
		}
		public function __destruct() { 
		}
		//default return if obj is echoed without method
		public function __toString(){
			return $this->getElement();
		}
		
		private function isDataOld(){
			$isold = FALSE;
			if (array_key_exists($this->$PostName,$_POST)) {
				if ($this->SQLTargetData[$this->Targetcol] != $_POST[$this->PostName]) {
					$isold = TRUE;
				}
			}
			return $isold;
		}
		
		private function SaveData(){
			switch ($this->InputType) {
				case 'text':
					$where = " AND id = " . $this->TargetID ;
					$sql =	"UPDATE {$GLOBALS['tableprefix']}_{$this->TargetTable}
							SET ".$this->TargetCol." = '".$_POST[$this->PostName]."' 
							WHERE 0=0 $where";
					mysql_query($sql);
				break;
				
				default:
				break;
			}
		}

		public function setInputType($typestring){
			$this->type = $typestring;
		}
		
		public function setElementTitle($titlestring){
			$this->ElementTitle = $titlestring;
		}
		
		public function setElementDescription($Descriptionstring){
			$this->ElementDescription = $Descriptionstring;
		}
		
		public function setTargetcol($col){
			$this->TargetCol = $col;
		}
		
		public function setTargetTable($TargetTable){
			$this->TargetTable = $TargetTable;
		}
		
		public function getElement(){
			switch ($this->InputType) {
				case 'text':
					$return .= "<label for='".$this->PostName."'>".$this->ElementTitle."<small>".$this->ElementDescription."</small></label>";
					$return .= "<div>" . $this->getInputTextfield() . "</div>";;
				break;
			}
			return $return
		}
		
		public function getInputTextfield(){
			return = "<input id=".$this->PostName." type='".$this->InputType."' name='$this->PostName' value='".$this->SQLTargetdata[$this->Targetcol]."'>";
		}
	

	}

	$form = new Form;
	$form->setOriginID($_GET["id"]);
	$form->setOriginTable("Menschen");
	$form->setButtonLabels(array("submit" => "Save", "cancel" => "Cancel", "delete" => FALSE, "publish" => FALSE));

		$name = new FormElement;
			$name->setInputType("text");
			$name->setElementTitle("Lastname");
			$name->setTargetcol("name");
			$name->setElementDescription("Enter your family-name here please.");
			echo $name->getElement();
		unset($name);
		
	unset($form);
	
	
	
	
	
	
?>