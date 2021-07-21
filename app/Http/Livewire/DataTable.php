<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DataTable extends Component{
  
  public $tableColumnsName = [];
  public $excludedColumns = [];
  public $tableRows = [];
  public $tableColumns = [];
  public $rowNameRepresentative = "id";
  public $deleteRoute;

  public function cleanColumnNames()
  {
      $oldColumn = $this->tableColumns;
      $newColumnName = [];
      $newColumn = [];
      $excludedColumns = $this->excludedColumns;

      for($i = 0; $i < sizeof($oldColumn); $i++){
          for($k = 0;$k < sizeof($excludedColumns);$k++ ){
              if($oldColumn[$i] == $excludedColumns[$k]){
                  $oldColumn[$i] = null;
              }
          }
          if(!$oldColumn[$i])continue;
          $spacedWords = explode("_", $oldColumn[$i]);
          $cleanWord = "";
          for($j = 0; $j < sizeof($spacedWords);$j++){
              $cleanWord = $cleanWord." ".ucfirst($spacedWords[$j]);
          }
          $newColumnName[] = $cleanWord;
          $newColumn[] = $oldColumn[$i];
      }
      $this->tableColumnsName = $newColumnName;
      $this->tableColumns = $newColumn;
  }

  public function mount()
  {
      $this->cleanColumnNames();
  }

  public function render()
  {
      return view('livewire.data-table');
  }

  
}