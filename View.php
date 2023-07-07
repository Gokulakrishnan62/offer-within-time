<?php

defined('ABSPATH') || exit;

$key = isset($key) ? (int) $key : '{key}';
$method = isset($condition['method']) && !empty($condition['method']) ? $condition['method'] : '';
$values = isset($condition['values']) && !empty($condition['values']) ? $condition['values'] : [];

?>


<div style="display: flex; width:100%;">
    <div class="">
        <select class="form-control" name="conditions[<?php echo esc_attr($key); ?>][method]" style="width: 11em">
            <option value="in" <?php if ($method == 'in') echo "selected"; ?>><?php esc_html_e("In", 'checkout-upsell-woocommerce'); ?></option>
            <option value="not_in" <?php if ($method == 'not_in') echo "selected"; ?>><?php esc_html_e("Not In", 'checkout-upsell-woocommerce'); ?></option>
        </select>
    </div>
        <div class='condition-values w-55 ml-2'>
            <input style="width:100%" type='time' class='form-control'  name="conditions[<?php echo esc_attr($key); ?>][values][from]" value="<?php echo isset($values['from']) ? esc_attr($values['from']) : ''; ?>">
        </div>
    <div style="margin-left: 21px; margin-top: 10px;"><b>to</b></div>
        <div class='condition-values w-55 ml-3'>
            <input type='time' class='form-control' name="conditions[<?php echo esc_attr($key); ?>][values][to]" value="<?php echo isset($values['to']) ? esc_attr($values['to']) : ''; ?>">
        </div>
</div>
