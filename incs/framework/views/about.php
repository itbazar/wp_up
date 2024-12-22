<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly. ?>

<p>Welcome to the exciting world of Wuppo Framework. Built in Object Oriented Programming paradigm with high number of custom fields and tons of options. Allows you to bring custom admin, metabox, taxonomy and customize settings to all of your pages, posts and categories. It's highly modern and advanced framework.</p>

<div class="wuppo-welcome-cols">

  <div class="wuppo--col wuppo--col-first">
    <span class="wuppo--icon wuppo--active"><i class="fas fa-check"></i></span>
    <div class="wuppo--title">Admin Option Framework</div>
    <p class="wuppo--text">Built in Object Oriented Programming paradigm with high number of custom fields and tons of options. It's highly modern and advanced framework.</p>
  </div>

  <div class="wuppo--col wuppo--col-first">
    <span class="wuppo--icon wuppo--<?php echo esc_attr( WUPPO::$premium ? 'active' : 'deactive' ); ?>"><i class="fas fa-<?php echo esc_attr( WUPPO::$premium ? 'check' : 'times' ); ?>"></i></span>
    <div class="wuppo--title">Customize Option Framework</div>
    <p class="wuppo--text">Inherits the default WordPress Customizer with integration of own custom fields. It's more powerful to customize your site on live.</p>
  </div>

  <div class="wuppo--col wuppo--col-first wuppo--last">
    <span class="wuppo--icon wuppo--<?php echo esc_attr( WUPPO::$premium ? 'active' : 'deactive' ); ?>"><i class="fas fa-<?php echo esc_attr( WUPPO::$premium ? 'check' : 'times' ); ?>"></i></span>
    <div class="wuppo--title">Metabox Option Framework</div>
    <p class="wuppo--text">Allows you to bring custom metabox settings to all of your pages and posts. We provide advanced settings with numerious number of fields.</p>
  </div>

  <div class="clear"></div>

  <div class="wuppo--col wuppo--col-first">
    <span class="wuppo--icon wuppo--<?php echo esc_attr( WUPPO::$premium ? 'active' : 'deactive' ); ?>"><i class="fas fa-<?php echo esc_attr( WUPPO::$premium ? 'check' : 'times' ); ?>"></i></span>
    <div class="wuppo--title">Nav Menu Option Framework</div>
    <p class="wuppo--text">Allows you to bring custom nav menu item settings to all of your menus. We provide advanced settings with numerious number of fields.</p>
  </div>

  <div class="wuppo--col wuppo--col-first">
    <span class="wuppo--icon wuppo--<?php echo esc_attr( WUPPO::$premium ? 'active' : 'deactive' ); ?>"><i class="fas fa-<?php echo esc_attr( WUPPO::$premium ? 'check' : 'times' ); ?>"></i></span>
    <div class="wuppo--title">Taxonomy Option Framework</div>
    <p class="wuppo--text">Allows you to bring custom taxonomy settings to all of your categories, tags or CPT. We provide advanced settings with numerious number of fields.</p>
  </div>

  <div class="wuppo--col wuppo--col-first wuppo--last">
    <span class="wuppo--icon wuppo--<?php echo esc_attr( WUPPO::$premium ? 'active' : 'deactive' ); ?>"><i class="fas fa-<?php echo esc_attr( WUPPO::$premium ? 'check' : 'times' ); ?>"></i></span>
    <div class="wuppo--title">Profile Option Framework</div>
    <p class="wuppo--text">Allows you to bring custom user profile settings to all of users. We provide advanced settings with numerious number of fields.</p>
  </div>

  <div class="clear"></div>

  <div class="wuppo--col">
    <span class="wuppo--icon wuppo--<?php echo esc_attr( WUPPO::$premium ? 'active' : 'deactive' ); ?>"><i class="fas fa-<?php echo esc_attr( WUPPO::$premium ? 'check' : 'times' ); ?>"></i></span>
    <div class="wuppo--title">Widget Option Framework</div>
    <p class="wuppo--text">Allows you to creating custom widgets. We provide advanced settings wtih numerious number of fields.</p>
  </div>

  <div class="wuppo--col">
    <span class="wuppo--icon wuppo--<?php echo esc_attr( WUPPO::$premium ? 'active' : 'deactive' ); ?>"><i class="fas fa-<?php echo esc_attr( WUPPO::$premium ? 'check' : 'times' ); ?>"></i></span>
    <div class="wuppo--title">Comment Option Framework</div>
    <p class="wuppo--text">Allows you to bring custom comment metabox settings to all of comments. We provide advanced settings wtih numerious number of fields.</p>
  </div>

  <div class="wuppo--col wuppo--last">
    <span class="wuppo--icon wuppo--<?php echo esc_attr( WUPPO::$premium ? 'active' : 'deactive' ); ?>"><i class="fas fa-<?php echo esc_attr( WUPPO::$premium ? 'check' : 'times' ); ?>"></i></span>
    <div class="wuppo--title">Shortcode Option Framework</div>
    <p class="wuppo--text">Comes with pre-built shortcode editor to manage your content. It's easy and flexible to build unlimited layouts with endless possibilites.</p>
  </div>

  <?php if ( ! WUPPO::$premium ) { ?>
  <div class="clear"></div>
  <div class="wuppo--col-upgrade">
    <a href="http://wuppoframework.com/" class="button button-primary" target="_blank" rel="nofollow"><i class="fas fa-share"></i> Upgrade Premium Version</a>
  </div>
  <?php } ?>

  <div class="clear"></div>
</div>

<hr />

<div class="wuppo-features-cols wuppo--col-wrap">
  <div class="wuppo--col wuppo--key-features">

  <h4>Key Features</h4>

  <ul>
    <li>WordPress 6.0.x Ready</li>
    <li>Gutenberg Ready</li>
    <li>Multiple instances</li>
    <li>Unlimited frameworks</li>
    <li>Output css styles</li>
    <li>Output typography</li>
    <li>Advanced option fields</li>
    <li>Fields dependencies based on rules</li>
    <li>Sanitize and validate fields</li>
    <li>Ajax saving</li>
    <li>Localization</li>
    <li>Useful hooks for configurations</li>
    <li>Export and import options</li>
    <li>and much more...</li>
  </ul>

  </div>

  <div class="wuppo--col wuppo--available-fields">

  <h4>Available Fields</h4>

  <table class="wuppo--table-fields fixed widefat">
    <tbody>
      <tr>
        <td>text</td>
        <td>accordion</td>
        <td>background</td>
        <td>backup</td>
        <td>icon</td>
      </tr>
      <tr>
        <td>textarea</td>
        <td>repeater</td>
        <td>heading</td>
        <td>date</td>
        <td>code_editor</td>
      </tr>
      <tr>
        <td>checkbox</td>
        <td>group</td>
        <td>image_select</td>
        <td>slider</td>
        <td>content</td>
      </tr>
      <tr>
        <td>select</td>
        <td>gallery</td>
        <td>notice</td>
        <td>fieldset</td>
        <td>typography</td>
      </tr>
      <tr>
        <td>switcher</td>
        <td>sorter</td>
        <td>link_color</td>
        <td>subheading</td>
        <td>upload</td>
      </tr>
      <tr>
        <td>color</td>
        <td>media</td>
        <td>radio</td>
        <td>tabbed</td>
        <td>wp_editor</td>
      </tr>
      <tr>
        <td>spacing</td>
        <td>border</td>
        <td>palette</td>
        <td>spinner</td>
        <td>dimensions</td>
      </tr>
      <tr>
        <td>link_color</td>
        <td>sortable</td>
        <td>button_set</td>
        <td>accordion</td>
        <td>others</td>
      </tr>
    </tbody>
  </table>

  <p>and more on the way...</p>

  </div>

  <div class="clear"></div>
</div>

<?php if ( WUPPO::$premium ) { ?>
<hr />
<h5>You can force to disable this page with (it would works for only premium users):</h5>
<div class="wuppo-code-block">
<pre>
add_filter( 'wuppo_welcome_page', '__return_false' );
</pre>
</div>
<?php } ?>
