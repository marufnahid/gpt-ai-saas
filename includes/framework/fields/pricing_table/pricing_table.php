<?php
if (!defined('ABSPATH')) {
    die; // Cannot access directly.
}

if (!class_exists('CSF_Field_pricing_table')) {
    class CSF_Field_pricing_table extends CSF_Fields
    {

        public function __construct($field, $value = '', $unique = '', $where = '', $parent = '')
        {
            parent::__construct($field, $value, $unique, $where, $parent);
        }

        public function render()
        {
            echo $this->field_before();

// Output the pricing table wrapper
            echo '<div class="container">';
//            echo '<div class="row">';
            echo '<div class="csf-pricing-table-items row" data-depend-id="' . esc_attr($this->field['id']) . '">';

            // Loop through each pricing table item
            foreach ($this->field['pricing_tables'] as $key => $pricing_table) {
                echo '<div class="csf-pricing-table-item column column-33">';

                // Output the pricing table title
                echo '<h4 class="csf-pricing-table-title">' . esc_html($pricing_table['title']) . '</h4>';

                // Output the pricing table content
                echo '<div class="csf-pricing-table-content">';
                // Loop through each feature in the pricing table
                foreach ($pricing_table['features'] as $feature) {
                    echo '<div class="csf-pricing-table-feature">';
                    echo '<span class="csf-pricing-table-feature-name">' . esc_html($feature['name']) . '</span>';
                    echo '<span class="csf-pricing-table-feature-value">' . esc_html($feature['value']) . '</span>';
                    echo '</div>';
                }
                echo '<a class="buy-now-button button button-primary" href="' . esc_url( strtolower($pricing_table['buy_now_link'])) . '">Buy Now</a>';

                echo '</div>'; // Close the pricing table content

                echo '</div>'; // Close the pricing table item
            }

            echo '</div>'; // Close the pricing table wrapper
//            echo '</div>'; // Close the pricing table row
            echo '</div>'; // Close the pricing table container


            echo $this->field_after();
        }
    }
}
