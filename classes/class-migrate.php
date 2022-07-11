<?php

namespace LOCALiQ\Plugin\Headers_Migration;

class Migrate {

  protected const HTTP_SEC_KEY_PREFIX = 'http_security_';
  protected const OPTIONS_KEY = 'localiq_http_security_migration';

  protected string $flag = '';

  function __construct(string $feature) {
    $this->check_flag($feature);
  }

  function check_flag(string $feature) {
      if (in_array($feature, [
        'sts',
        'ct_enforce',
        'csp',
        'feature_policy',
        'x_frame'
      ], true)) {
      $this->flag = self::HTTP_SEC_KEY_PREFIX . $feature . '_flag';
    }

  }

  function is_flagged_group() {
    return ! empty($this->flag);
  }


  function get_settings(): array {
    add_filter('option_'. self::OPTIONS_KEY, function($option):array { return (array)$option; } );
    
    return get_option(self::OPTIONS_KEY, []);
   }
  
   function update_settings(array $new_settings): bool {
    $current_settings = $this->get_settings();

    return update_option(self::OPTIONS_KEY, [...$current_settings, ...$new_settings]);
   }
   
   function is_complete($key):bool {
    return !empty($this->get_settings()['complete'][$key]);
  }
  
    function mark_complete($key) {
      $migration_settings = $this->get_settings();
      $migration_settings['completed'][$key] = true;

      $this->update_settings($migration_settings);
    }

  function migrate_data($from, $to) {}

}

 