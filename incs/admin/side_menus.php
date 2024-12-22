<div class="col-12 bg-cover">
    <div class="w-100 h-100 position-relative wupp-admin-sidemenu">
        <div id="accordion">
            <div class="col-12 p-0">
                <?php if ($settings_menus && count($settings_menus) > 0) : ?>
                    <?php $menu_count = 0; ?>
                    <?php foreach ($settings_menus as $settings_menu) : ?>
                        <?php if ($settings_menu['menu_sub_menus'] && count($settings_menu['menu_sub_menus']) > 0) : ?>
                            <div class="wupp_menu_item">
                                <div class="card-header option-container option-container-b-a position-relative p-0" id="heading<?php echo $settings_menu['menu_slug']; ?>">
                                    <h5 class="mb-0 option-items itemBeforeActive overflow-hidden">
                                        <button class="option-btn position-relative btn btn-link w-100 py-2 text-decoration-none wupp-btn-menu-header" data-toggle="collapse" data-target="#collapse<?php echo $settings_menu['menu_slug']; ?>" aria-expanded="<?php echo $menu_count ? 'false' : 'true' ?>" aria-controls="collapse<?php echo $settings_menu['menu_slug']; ?>">
                                            <i class="
                                             <?php echo $settings_menu['menu_icon']; ?> icons"></i>
                                            <?php echo $settings_menu['menu_title']; ?>
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapse<?php echo $settings_menu['menu_slug']; ?>" class="collapse <?php echo $menu_count ? '' : 'show'; ?>" aria-labelledby="heading<?php echo $settings_menu['menu_slug']; ?>" data-parent="#accordion">
                                    <div class="card-body p-0 menu-body">
                                        <ul class="nav list-group " id="pills-tab" role="tablist">
                                            <?php $sub_menus = $settings_menu['menu_sub_menus']; ?>
                                            <?php $sub_menus = apply_filters('wupp_sub_menus_' . $settings_menu['menu_slug'], $sub_menus); ?>
                                            <?php if ($sub_menus && is_array($sub_menus) && count($sub_menus) > 0) : ?>
                                                <?php $sub_menu_count = 0; ?>
                                                <?php foreach ($sub_menus as $sub_menu) : ?>
                                                    <?php $bool_active = !isset($sub_menu['sub_menu_is_active']) || $sub_menu['sub_menu_is_active'] === true ?>
                                                    <?php if ($bool_active && $sub_menu['sub_menu_parent_slug'] == $settings_menu['menu_slug']) : ?>
                                                        <li class="list-group-item-action mb-0 nav-item position-relative overflow-hidden ">
                                                            <a class="nav-link py-auto px-0 mx-3 w-auto my-auto position-relative <?php echo ($sub_menu_count == 0 && $menu_count == 0) ? 'active text-white' : ''; ?> dropDown-items" id="pills-<?php echo $sub_menu['sub_menu_slug']; ?>-tab" data-toggle="pill" href="#pills-<?php echo $sub_menu['sub_menu_slug']; ?>" role="tab" aria-controls="pills-<?php echo $sub_menu['sub_menu_slug']; ?>">
                                                                <span class="position-relative" aria-selected="true"><?php echo $sub_menu['sub_menu_title']; ?>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <?php $sub_menu_count++; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php $menu_count++; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function() {
        jQuery('.nav-pills a').on('click', function() {
            var id = jQuery(this).attr('id');
            jQuery('.nav-pills a').each(function() {
                if (id !== jQuery(this).attr('id')) {
                    jQuery(this).removeClass('active', 'text-white');
                }
            });
        })
    });
</script>
<script type="text/javascript">
    const optionItems = document.querySelectorAll(".option-items");
    const icons = document.querySelectorAll(".icons");
    const optcontainer = document.querySelectorAll(".option-container-b-a");
    const dropitems = document.querySelectorAll(".dropDown-items");
    const dropCover = document.querySelectorAll(".drop-cover");

    optionItems.forEach((item, i) => {
        if (i == 0) {
            item.classList.add("itemActive", "option-items-a");
            icons[i].classList.add("icon-active");
            optcontainer[i].classList.toggle("option-container-a");
        }
        item.addEventListener("click", (e) => {
            item.classList.add("option-items-a");
            item.classList.add("itemActive");
            item.classList.add("option-items-a");
            icons[i].classList.add("icon-active");
            optcontainer[i].classList.add("option-container-a");
            let j;
            for (j = 0; j <= optionItems.length; j++) {
                console.log(`j is ${j} and i is ${i}`);
                if (j != i) {
                    try {
                        optionItems[j].classList.remove("option-items-a");
                        optionItems[j].classList.remove("itemActive");
                        optionItems[j].classList.remove("option-items-a");
                        icons[j].classList.remove("icon-active");
                        optcontainer[j].classList.remove("option-container-a");
                    } catch (exception) {}
                }
            }

        });

    });
    //icon animation
    dropitems.forEach((item, i) => {
        if (item.classList.contains("active")) {
            item.classList.add("dropDown-items-a");
        }
        item.addEventListener("click", () => {
            let j;
            for (j = 0; j <= dropitems.length - 1; j++) {
                if (dropitems[j].className !== "active") {
                    dropitems[j].classList.remove("dropDown-items-a");
                }
            }
            item.classList.add("dropDown-items-a");
        })

    })
</script>