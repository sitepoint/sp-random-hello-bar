<?php
$next      = 0;
$alternate = '';
?>
<table class="form-table">
  <tr>
    <th>HTML</th>
    <th>Weight</th>
    <th></th>
  </tr>
  <?php foreach($ads as $key => $ad) : ?>
  <tr class="<?php echo $alternate; ?>">
    <td>
      <textarea name="<?php echo self::PLUGIN_NAME; ?>-ads[<?php echo $key; ?>][html]" rows="10" cols="100"><?php echo esc_textarea($ad['html']); ?></textarea>
    </td>
    <th>
      <input type="text" name="<?php echo self::PLUGIN_NAME; ?>-ads[<?php echo $key; ?>][weight]" value="<?php echo absint($ad['weight']); ?>" />
    </th>
    <th>
      <label class="button">
        <input type="checkbox" name="<?php echo self::PLUGIN_NAME; ?>-ads[<?php echo $key; ?>][delete]" value="1" onchange="this.form.submit()" style="display: none;" />Delete
      </label>
    </th>
  </tr>
  <?php
    $next      = $key + 1;
    $alternate = ($alternate) ? '' : 'alternate';
  ?>
  <?php endforeach; ?>
  <tr class="<?php echo $alternate; ?>">
    <td>
      <textarea name="<?php echo self::PLUGIN_NAME; ?>-ads[<?php echo $next; ?>][html]" rows="10" cols="100"></textarea>
    </td>
    <th>
      <input type="text" name="<?php echo self::PLUGIN_NAME; ?>-ads[<?php echo $next; ?>][weight]" >
    </th>
    <td>
    </td>
  </tr>
</table>
