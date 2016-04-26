<?php
/**
 * showTvList
 *
 * ОПИСАНИЕ:
 * Сниппет выводит все ТВ значения для текущего ресурса
 *
 *
 * СВОЙСТВА:
 *
 * &tplWrapper - внешняя обертка По умолчанию: @INLINE  <ul>[[+fieldsResult]]</ul>
 * 
 * &tplCat - чанк для категории с её полями По умолчанию: @INLINE  <li><h4>[[+category]]</h4> <ul>[[+rows]]</ul></li>
 *      Доступные поля:
 *      [[+category]] - Наименование категории
 *      [[+rows]] - массив всех полей
 * 
 * &tplRow  чанк для одного ряда полей По умолчанию: <li>[[+name]]: [[+caption]] - [[+value]]</li>
 *      Доступные поля:
 *      [[+id]] - id ТВ 
 *      [[+default]] - значение по умолчанию
 *      [[+description]] - описание ТВ поля 
 *      [[+name]] - имя ТВ (как храниться в базе данных)
 *      [[+value]] - значение ТВ  
 *      [[+caption]] - Заголовок ТВ 
 * 
 * &id - id ресурса, по умолчанию берется текущий документ
 * &includeTv - список id необходимых ТВ полей через запятую
 * &excludeTv - список id ТВ полей через запятую? которые НЕ надо выводить
 * &includeCat - список id необходимых категорий через запятую (категории и её поля)
 * &excludeCat - список  id категорий через запятую, которые НЕ надо выводить (категории и её поля)
 * 
 * &getAllName - указывает что необходимо вывести ВСЕ имена(!только именна) TV полей, вне зависимости от ID или Parents
 *  - это необходимо для передачи списка TV в другие сниппеты, например в mFilter2
 * При указании этого параметра доступен только плейсхолдер [[+name]] и 2 чанка tplRow и tplRowLast
 * При указании этого параметра работает только дополнительный параметр includeCat. Остальные параметры не работают.
 * 
 * INLINE чанки поддерживает только при наличии pdoTools
 *
 * ИСПОЛЬЗОВАНИЕ:
 *
    [[!showTvList?     
       &excludeTv = `1,2` 
       &includeTv = `4,3` 
       &tplWrapper = `tpl.fieldsWrapper`
       &tplCat = `tpl.fieldsCat`
       &tplRow = `tpl.fieldsRow`
    ]]
    
 *
 */


// properties
if (empty($tplWrapper)) {$tplWrapper = '@INLINE  <ul>[[+fieldsResult]]</ul>';}
if (empty($tplCat)) {$tplCat = '@INLINE  <li><h4>[[+category]]</h4> <ul>[[+rows]]</ul></li>';}
if (empty($tplRow)) {$tplRow = '@INLINE  <li>[[+name]]: [[+caption]] - [[+value]]</li>';}
if (!empty($excludeTv)) { $excludeTv = explode(",", $excludeTv); } 
if (!empty($includeTv)) { $includeTv = explode(",", $includeTv); } 
if (!empty($excludeCat)) { $excludeCat = explode(",", $excludeCat); }  
if (!empty($includeCat)) { $includeCat = explode(",", $includeCat); } 
if (empty($id)) { $id = $modx->resource->get('id'); } 


// подключаем pdoTools для работы INLINE чанков 
if (file_exists(MODX_CORE_PATH . 'components/pdotools')) {
    $pdoTools = $modx->getService('pdoTools');
}
  
$outputRow = '';
$outputCat = '';
$tvs = array(); 


if (!empty($getAllName)) {
    
    if($includeCat){
        $includeCat = implode(",", $includeCat);
        $tvs = $modx->getCollection('modTemplateVar',array(
           'category' => 'IN ('.$includeCat.')'
        )
    );
        
    }
    else{
        $tvs = $modx->getCollection('modTemplateVar');
    }
    
    $total = count($tvs);
    $i = 1; 
    
    foreach($tvs as $tv){ 
        
        if(($total == $i ) AND !empty($tplRowLast)){ $tplRow = $tplRowLast; }
        
        if($pdoTools){ 
            $outputRow .= $pdoTools->getChunk( $tplRow , array(
                'name' => $tv->get('name')
            ));
        }
        else{
            $outputRow .= $modx->getChunk( $tplRow , array( 
                'name' => $tv->get('name')
            )); 
        } 
        
        $i++;
    }
 
    return $outputRow;
} 

$tv_query = $modx->newQuery('modTemplateVarResource');
$tv_query->leftJoin('modTemplateVar','modTemplateVar',array("modTemplateVar.id = modTemplateVarResource.tmplvarid"));
$tv_query->leftJoin('modCategory','modCategory',array("modCategory.id = modTemplateVar.category"));
$tv_query->leftJoin('modTemplateVarTemplate','modTemplateVarTemplate',array("modTemplateVarTemplate.tmplvarid = modTemplateVarResource.tmplvarid"));

$tv_query->where(array( 'contentid'=>$id ));
    
if($excludeTv)  { $tv_query->where(array( 'tmplvarid:NOT IN'=> $excludeTv )); }
if($excludeCat)  { $tv_query->where(array( 'modTemplateVar.category:NOT IN'=> $excludeCat )); }
if( $includeTv[0] > 0 )  { $tv_query->where(array( 'tmplvarid:IN' => $includeTv )); }
if( $includeCat[0] > 0 ) { $tv_query->where(array( 'modTemplateVar.category:IN' => $includeCat )); }

$tv_query->sortby('modCategory.id','ASC');
$tv_query->sortby('modTemplateVarTemplate.rank','ASC');
$tv_query->select($modx->getSelectColumns('modTemplateVarResource','modTemplateVarResource','',array('id','tmplvarid','contentid','value')));
$tv_query->select($modx->getSelectColumns('modTemplateVar','modTemplateVar','',array('id', 'name', 'caption', 'default_text', 'description')));
$tv_query->select($modx->getSelectColumns('modCategory','modCategory','',array('category')));

$tvars = $modx->getCollection('modTemplateVarResource',$tv_query);

$arrTvs = array();

foreach ($tvars as $tvar) {
    $tvar = $tvar->toArray();
    
    if (!empty($tvar['value'])){ 
        $arrTvs[$tvar['category']][] = array(
            "value" =>$tvar['value'], 
            "caption"=> $tvar['caption'], 
            "name"=> $tvar['name'], 
            "id"=> $tvar['id'], 
            "default"=> $tvar['default_text'],
            "description"=> $tvar['description']
        );
    } 
    
} // foreach

foreach($arrTvs as $category=>$fields){
    
    $outputRow = '';
    
    foreach($fields as $field){ 
        
        if($pdoTools){ 
            $outputRow .= $pdoTools->getChunk( $tplRow , array(
                'id' => $field['id'],
                'caption' => $field['caption'],
                'name' => $field['name'],
                'value' => $field['value'],
                'description' => $field['description'],
                'default' => $field['default']
            ));
        }
        else{
            $outputRow .= $modx->getChunk( $tplRow , array(
                'id' => $field['id'],
                'caption' => $field['caption'],
                'name' => $field['name'],
                'value' => $field['value'],
                'description' => $field['description'],
                'default' => $field['default']
            )); 
            
        }
            
    } // foreach
    
    
    if($pdoTools){ 
        $outputCat .= $pdoTools->getChunk( $tplCat , array(
            'category' =>  $category,
            'rows' => $outputRow 
        ));
    }
    else{
        $outputCat .= $modx->getChunk( $tplCat , array(
            'category' =>  $category,
            'rows' => $outputRow 
        )); 
    }
    
} // foreach
 

if($pdoTools){ 
    $result =  $pdoTools->getChunk( $tplWrapper , array(
       'fieldsResult' => $outputCat
    )); 
}
else{
    $result =  $modx->getChunk( $tplWrapper , array(
       'fieldsResult' => $outputCat
    )); 
}

return $result;
