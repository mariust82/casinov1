<?php
class ResultSetWrapper
{
    private static $instance;
    private $resultSet;
    
    public static function from(\Lucinda\SQL\StatementResults $resultSet) {
        self::$instance = new ResultSetWrapper($resultSet);
        return self::$instance;
    }
    
    private function __construct(\Lucinda\SQL\StatementResults $resultSet) {
        $this->resultSet = $resultSet;
    }
    
    private function translateToEntity( &$entity, $row, $pre = '' ){
        foreach( $row as $column => $value ){
            $clean_column = str_replace($pre,'',$column);
            if( property_exists($entity,$clean_column) ) $entity->$clean_column = $value;
        }
    }
    
    public function toItem($entityClass, $extraEntityClasses = []){
        $list = $this->toList($entityClass,$extraEntityClasses);
        return array_shift($list);
    }
    
    public function toList( $entityClass, $extraEntityClasses = [] ){
        $output = [];
        while( $row = $this->resultSet->toRow() ){
            $entity = new $entityClass;
            $this->translateToEntity($entity,$row);
            foreach( $extraEntityClasses as $pre => $extraEntityClass ){
                $extraEntity = new $extraEntityClass;
                $this->translateToEntity($extraEntity,$row,$pre.'.');
                $entity->$pre = $extraEntity;
            }
            $output[] = $entity;
        }
        return $output;
    }
}

