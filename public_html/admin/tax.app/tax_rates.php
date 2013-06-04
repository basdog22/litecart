<?php
  if (!isset($_GET['page'])) $_GET['page'] = 1;
?>
<div style="float: right;"><?php echo $system->functions->form_draw_link_button($system->document->link('', array('doc' => 'edit_tax_rate.php'), true), $system->language->translate('title_add_new_tax_rate', 'Add New Tax Rate'), '', 'add'); ?></div>
<h1 style="margin-top: 0px;"><img src="<?php echo WS_DIR_ADMIN . $_GET['app'] .'.app/icon.png'; ?>" width="32" height="32" style="vertical-align: middle; margin-right: 10px;" /><?php echo $system->language->translate('title_tax_rates', 'Tax Rates'); ?></h1>

<?php echo $system->functions->form_draw_form_begin('tax_rates_form', 'post'); ?>
<table width="100%" align="center" class="dataTable">
  <tr class="header">
    <th><?php echo $system->functions->form_draw_checkbox('checkbox_toggle', '', ''); ?></th>
    <th nowrap="nowrap" align="left"><?php echo $system->language->translate('title_id', 'ID'); ?></th>
    <th nowrap="nowrap" align="left"><?php echo $system->language->translate('title_tax_class', 'Tax Class'); ?></th>
    <th nowrap="nowrap" align="left"><?php echo $system->language->translate('title_geo_zone', 'Geo Zone'); ?></th>
    <th nowrap="nowrap" align="left"><?php echo $system->language->translate('title_name', 'Name'); ?></th>
    <th nowrap="nowrap" align="left" width="100%"><?php echo $system->language->translate('title_description', 'Description'); ?></th>
    <th nowrap="nowrap" align="left"><?php echo $system->language->translate('title_rate', 'Rate'); ?></th>
    <th nowrap="nowrap" align="left"><?php echo $system->language->translate('title_type', 'Type'); ?></th>
    <th>&nbsp;</th>
  </tr>
<?php

  $tax_rates_query = $system->database->query(
    "select tr.*, gz.name as geo_zone, tc.name as tax_class from ". DB_TABLE_TAX_RATES ." tr
    left join ". DB_TABLE_GEO_ZONES ." gz on (gz.id = tr.geo_zone_id)
    left join ". DB_TABLE_TAX_CLASSES ." tc on (tc.id = tr.tax_class_id)
    order by tr.name, gz.name;"
  );

  if ($system->database->num_rows($tax_rates_query) > 0) {
    
  // Jump to data for current page
    if ($_GET['page'] > 1) $system->database->seek($tax_rates_query, ($system->settings->get('data_table_rows_per_page') * ($_GET['page']-1)));
    
    $page_items = 0;
    while ($tax_rate = $system->database->fetch($tax_rates_query)) {
    
      if (!isset($rowclass) || $rowclass == 'even') {
        $rowclass = 'odd';
      } else {
        $rowclass = 'even';
      }
?>
  <tr class="<?php echo $rowclass; ?>">
    <td><?php echo $system->functions->form_draw_checkbox('tax_rates['. $tax_rate['id'] .']', $tax_rate['id']); ?></td>
    <td align="left"><?php echo $tax_rate['id']; ?></td>
    <td align="left" nowrap="nowrap"><?php echo $tax_rate['tax_class']; ?></td>
    <td align="left" nowrap="nowrap"><?php echo $tax_rate['geo_zone']; ?></td>
    <td align="left" nowrap="nowrap"><?php echo $tax_rate['name']; ?></td>
    <td align="left"><?php echo $tax_rate['description']; ?></td>
    <td align="left"><?php echo number_format($tax_rate['rate'], 2); ?></td>
    <td align="left"><?php echo $tax_rate['type']; ?></td>
    <td align="right"><a href="<?php echo $system->document->href_link('', array('doc' => 'edit_tax_rate.php', 'tax_rate_id' => $tax_rate['id']), true); ?>"><img src="<?php echo WS_DIR_IMAGES . 'icons/16x16/edit.png'; ?>" width="16" height="16" alt="<?php echo $system->language->translate('title_edit', 'Edit'); ?>" title="<?php echo $system->language->translate('title_edit', 'Edit'); ?>" /></a></td>
  </tr>
<?php
      if (++$page_items == $system->settings->get('data_table_rows_per_page')) break;
    }
  }
?>
  <tr class="footer">
    <td colspan="9" align="left"><?php echo $system->language->translate('title_tax_rates', 'Tax Rates'); ?>: <?php echo $system->database->num_rows($tax_rates_query); ?></td>
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
  echo $system->functions->draw_pagination(ceil($system->database->num_rows($tax_rates_query)/$system->settings->get('data_table_rows_per_page')));
?>