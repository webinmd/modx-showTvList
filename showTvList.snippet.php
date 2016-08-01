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
    
* Пример 2  (с параметром getAllName)
    [[!showTvList? 
    &getAllName=`1` 
    &includeCat=`6,8`
    &tplRow=`@INLINE  tv|[[+name]],`
    &tplRowLast=`@INLINE  tv|[[+name]]`
    ]]

    
 *
 */
 
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
 * &translit - переводит в латиницу все name полей (работает только вместе с параметром getAllName)
 * 
 * &getAllName - указывает что необходимо вывести ВСЕ имена(!только именна) TV полей, вне зависимости от ID или Parents
 *  - это необходимо для передачи списка TV в другие сниппеты, например в mFilter2
 * При указании этого параметра доступен только плейсхолдер [[+name]] и 2 чанка tplRow и tplRowLast
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
    
* Пример 2  (с параметром getAllName)
    [[!showTvList? 
    &getAllName=`1` 
    &includeCat=`6,8`
    &tplRow=`@INLINE  tv|[[+name]],`
    &tplRowLast=`@INLINE  tv|[[+name]]`
    &translit = `1`
    ]]
    
 *
 */
  
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
    
* Пример 2  (с параметром getAllName)
    [[!showTvList? 
    &getAllName=`1` 
    &includeCat=`6,8`
    &tplRow=`@INLINE  tv|[[+name]],`
    &tplRowLast=`@INLINE  tv|[[+name]]`
    ]]
    
 *
 */
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

if (!function_exists('transliterate')) {

    function transliterate($st) {
        
        $replace=array(
        		"'"=>"",
        		"`"=>"",
        		" "=>"_",
        		"а"=>"a","А"=>"a",
        		"б"=>"b","Б"=>"b",
        		"в"=>"v","В"=>"v",
        		"г"=>"g","Г"=>"g",
        		"д"=>"d","Д"=>"d",
        		"е"=>"e","Е"=>"e",
        		"ж"=>"zh","Ж"=>"zh",
        		"з"=>"z","З"=>"z",
        		"и"=>"i","И"=>"i",
        		"й"=>"y","Й"=>"y",
        		"к"=>"k","К"=>"k",
        		"л"=>"l","Л"=>"l",
        		"м"=>"m","М"=>"m",
        		"н"=>"n","Н"=>"n",
        		"о"=>"o","О"=>"o",
        		"п"=>"p","П"=>"p",
        		"р"=>"r","Р"=>"r",
        		"с"=>"s","С"=>"s",
        		"т"=>"t","Т"=>"t",
        		"у"=>"u","У"=>"u",
        		"ф"=>"f","Ф"=>"f",
        		"х"=>"h","Х"=>"h",
        		"ц"=>"c","Ц"=>"c",
        		"ч"=>"ch","Ч"=>"ch",
        		"ш"=>"sh","Ш"=>"sh",
        		"щ"=>"sch","Щ"=>"sch",
        		"ъ"=>"","Ъ"=>"",
        		"ы"=>"y","Ы"=>"y",
        		"ь"=>"","Ь"=>"",
        		"э"=>"e","Э"=>"e",
        		"ю"=>"yu","Ю"=>"yu",
        		"я"=>"ya","Я"=>"ya",
        		"і"=>"i","І"=>"i",
        		"ї"=>"yi","Ї"=>"yi",
        		"є"=>"e","Є"=>"e"
        	);
    	return $str=iconv("UTF-8","UTF-8//IGNORE",strtr($st,$replace));
    }
  
}

if (!empty($getAllName)) {
    
    $tv_query = $modx->newQuery('modTemplateVar');
    if($excludeTv)  { $tv_query->where(array( 'modTemplateVar.id:NOT IN'=> $excludeTv )); }
    if($excludeCat)  { $tv_query->where(array( 'modTemplateVar.modTemplateVar.category:NOT IN'=> $excludeCat )); }
    if($includeTv[0] > 0)  { $tv_query->where(array( 'modTemplateVar.id:IN' => $includeTv )); }
    
    if( $includeCat == 0 ) { 
        $tv_query->where(array( 'modTemplateVar.category:IN' => array('0') )); 
    } 
    else{
        if( count($includeCat)>0 ) { $tv_query->where(array( 'modTemplateVar.category:IN' => $includeCat )); }
    }
    
    $tvs = $modx->getCollection('modTemplateVar',$tv_query);
     
    $total = count($tvs);
    $i = 1; 
    
    foreach($tvs as $tv){ 
        
        if(($total == $i ) AND !empty($tplRowLast)){ $tplRow = $tplRowLast; }
        
        if($translit) {
            $nameTranslit = transliterate($tv->get('name'));
        } else{
            $nameTranslit = '';
        }
        
        if($pdoTools){ 
            $outputRow .= $pdoTools->getChunk( $tplRow , array(
                'name' => strtolower($tv->get('name')),
                'nameTranslit' => $nameTranslit
            ));
        }
        else{
            $outputRow .= $modx->getChunk( $tplRow , array( 
                'name' =>strtolower($tv->get('name')),
                'nameTranslit' => $nameTranslit
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
              
        if($replace){
            $field['value'] = str_replace("||", ", ", $field['value']);
        }
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
