<?php
  if (!isset($_GET['page'])) $_GET['page'] = 1;
?>
<div style="float: right;"><?php echo $system->functions->form_draw_link_button($system->document->link('', array('doc' => 'edit_geo_zone.php'), true, array('geo_zone_id')), $system->language->translate('title_add_new_geo_zone', 'Add New Geo Zone'), '', 'add'); ?></div>
<h1 style="margin-top: 0px;"><img src="<?php echo WS_DIR_ADMIN . $_GET['app'] .'.app/icon.png'; ?>" width="32" height="32" style="vertical-align: middle; margin-right: 10px;" /><?php echo $system->language->translate('title_geo_zones', 'Geo Zones'); ?></h1>

<?php echo $system->functions->form_draw_form_begin('geo_zones_form', 'post'); ?>
<table width="100%" align="center" class="dataTable">
  <tr class="header">
    <th><?php echo $system->functions->form_draw_checkbox('checkbox_toggle', '', ''); ?></th>
    <th nowrap="nowrap" align="left"><?php echo $system->language->translate('title_id', 'ID'); ?></th>
    <th nowrap="nowrap" align="left" width="100%"><?php echo $system->language->translate('title_name', 'Name'); ?></th>
    <th nowrap="nowrap" align="left"><?php echo $system->language->translate('title_zones', 'Zones'); ?></th>
    <th>&nbsp;</th>
  </tr>
<?php

  $geo_zones_query = $system->database->query(
    "select * from ". DB_TABLE_GEO_ZONES ."
    order by name asc;"
  );

  if ($system->database->num_rows($geo_zones_query) > 0) {
    
    if ($_GET['page'] > 1) $system->database->seek($geo_zones_query, ($system->settings->get('data_table_rows_per_page') * ($_GET['page']-1)));
    
    $page_items = 0;
    while ($geo_zone = $system->database->fetch($geo_zones_query)) {
    
      if (!isset($rowclass) || $rowclass == 'even') {
        $rowclass = 'odd';
      } else {
        $rowclass = 'even';
      }
?>
  <tr class="<?php echo $rowclass; ?>">
    <td><?php echo $system->functions->form_draw_checkbox('geo_zones['. $geo_zone['id'] .']', $geo_zone['id']); ?></td>
    <td align="left"><?php echo $geo_zone['id']; ?></td>
    <td align="left" nowrap="nowrap"><?php echo $geo_zone['name']; ?></td>
    <td align="left"><?php echo $system->database->num_rows($system->database->query("select id from ". DB_TABLE_ZONES_TO_GEO_ZONES ." where geo_zone_id = '". (int)$geo_zone['id'] ."'")); ?></td>
    <td align="right"><a href="<?php echo $system->document->href_link('', array('doc' => 'edit_geo_zone.php', 'geo_zone_id' => $geo_zone['id']), true); ?>"><img src="<?php echo WS_DIR_IMAGES . 'icons/16x16/edit.png'; ?>" width="16" height="16" alt="<?php echo $system->language->translate('title_edit', 'Edit'); ?>" title="<?php echo $system->language->translate('title_edit', 'Edit'); ?>" /></a></td>
  </tr>
<?php
      if (++$page_items == $system->settings->get('data_table_rows_per_page')) break;
    }
  }
?>
  <tr class="footer">
    <td colspan="5" align="left"><?php echo $system->language->translate('title_geo_zones', 'Geo Zones'); ?>: <?php echo $system->database->num_rows($geo_zones_query); ?></td>
  </tr>
</table>
<script type="text/javascript">
  $(".dataTable input[name='checkbox_toggle']").click(function() {
    $(this).closest("form").find(":checkbox").each(function() {
      $(this).attr('checked', !$(this).attr('checked'));
    });
    $(".dataTable input[name='checkbox_toggle']").attr("checked", true);
  });

  $('.dataTable tr').click(function(event) {
    if ($(event.target).is('input:checkbox')) return;
    if ($(event.target).is('a, a *')) return;
    if ($(event.target).is('th')) return;
    $(this).find('input:checkbox').trigger('click');
  });
</script>
<?php
  echo $system->functions->form_draw_form_end();
  
// Display page links
  echo $system->functions->draw_pagination(ceil($system->database->num_rows($geo_zones_query)/$system->settings->get('data_table_rows_per_page')));
?>