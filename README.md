## modx-showTvList
Список всех ТВ параметров

### showTvList

**ОПИСАНИЕ:**
Сниппет выводить все ТВ значения для текущего ресурса


**СВОЙСТВА:**

&tplWrapper - внешняя обертка По умолчанию: @INLINE  <ul>[[+fieldsResult]]</ul>

&tplCat - чанк для категории с её полями По умолчанию: @INLINE  <li><h4>[[+category]]</h4> <ul>[[+rows]]</ul></li>
Доступные поля:
 *      [[+category]] - Наименование категории
 *      [[+rows]] - массив всех полей


 * &tplRow  чанк для одного ряда полей По умолчанию: <li>[[+name]]: [[+caption]] - [[+value]]</li>
 *      Доступные поля:
 *      [[+id]] - id ТВ 
 *      [[+default]] - значение по умолчанию
 *      [[+description]] - описание ТВ поля 
 *      [[+name]] - имя ТВ (как храниться в базе данных)
 *      [[+value]] - значение ТВ  
 *      [[+caption]] - Заголовок ТВ 


 * &id - id ресурса, по умолчанию берется текущий документ
 * &includeTv - список id необходимых ТВ полей через запятую
 * &excludeTv - список id ТВ полей через запятую? которые НЕ надо выводить
 * &includeCat - список id необходимых категорий через запятую (категории и её поля)
 * &excludeCat - список  id категорий через запятую, которые НЕ надо выводить (категории и её поля)

 * При установленном pdoTools ПОДДЕРЖИВАЕТ INLINE чанки, без него - НЕ поддерживает, только tpl 


 * ИСПОЛЬЗОВАНИЕ:

    [[!allTvFields?     
       &excludeTv = `1,2` 
       &includeTv = `4,3` 
       &tplWrapper = `tpl.fieldsWrapper`
       &tplCat = `tpl.fieldsCat`
       &tplRow = `tpl.fieldsRow`
    ]]
