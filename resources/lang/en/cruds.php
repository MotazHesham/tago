<?php

return [
    'userManagement' => [
        'title'          => 'إدارة المستخدمين',
        'title_singular' => 'إدارة المستخدمين',
    ],
    'permission' => [
        'title'          => 'الصلاحيات',
        'title_singular' => 'الصلاحية',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'المجموعات',
        'title_singular' => 'مجموعة',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'المستخدمين',
        'title_singular' => 'مستخدم',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'phone_number'             => 'Phone Number',
            'phone_number_helper'      => ' ',
            'nickname'                 => 'Nickname',
            'nickname_helper'          => ' ',
            'bio'                      => 'Bio',
            'bio_helper'               => ' ',
            'email_active'             => 'Email Active',
            'email_active_helper'      => ' ',
            'nickname_active'          => 'Nickname Active',
            'nickname_active_helper'   => ' ',
            'bio_active'               => 'Bio Active',
            'bio_active_helper'        => ' ',
            'photo'                    => 'Photo',
            'photo_helper'             => ' ',
            'cover'                    => 'Cover',
            'cover_helper'             => ' ',
        ],
    ],
    'auditLog' => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'userAlert' => [
        'title'          => 'User Alerts',
        'title_singular' => 'User Alert',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => 'Alert Text',
            'alert_text_helper' => ' ',
            'alert_link'        => 'Alert Link',
            'alert_link_helper' => ' ',
            'user'              => 'Users',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
        ],
    ],
    'productManagment' => [
        'title'          => 'Product Managment',
        'title_singular' => 'Product Managment',
    ],
    'product' => [
        'title'          => 'Product',
        'title_singular' => 'Product',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'price'              => 'Price',
            'price_helper'       => ' ',
            'photo'              => 'Photo',
            'photo_helper'       => ' ',
            'colors'              => 'Colors',
            'colors_helper'       => ' ',
            'current_stock'              => 'Stock',
            'current_stock_helper'       => ' ',
            'meta_title'              => 'meta Title',
            'meta_title_helper'       => ' ',
            'meta_description'              => 'meta Description',
            'meta_description_helper'       => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'category'           => 'Category',
            'category_helper'    => ' ',
        ],
    ],
    'generalSetting' => [
        'title'          => 'General Settings',
        'title_singular' => 'General Setting',
    ],
    'setting' => [
        'title'          => 'Settings',
        'title_singular' => 'Setting',
        'fields'         => [
            'id'                             => 'ID',
            'id_helper'                      => ' ',
            'website_name'                   => 'Website Name',
            'website_name_helper'            => ' ',
            'email'                          => 'Email',
            'email_helper'                   => ' ',
            'phone_number'                   => 'Phone Number',
            'phone_number_helper'            => ' ',
            'facebook'                       => 'Facebook',
            'facebook_helper'                => ' ',
            'instagram'                      => 'Instagram',
            'instagram_helper'               => ' ',
            'logo'                           => 'Logo',
            'logo_helper'                    => ' ',
            'created_at'                     => 'Created at',
            'created_at_helper'              => ' ',
            'updated_at'                     => 'Updated at',
            'updated_at_helper'              => ' ',
            'deleted_at'                     => 'Deleted at',
            'deleted_at_helper'              => ' ',
            'description'                    => 'Description',
            'description_helper'             => ' ',
            'how_it_work_description'        => 'How It Work Description',
            'how_it_work_description_helper' => ' ',
            'how_it_work'                    => 'How It Work',
            'how_it_work_helper'             => 'Iframe from Youtube',
            'address'                        => 'Address',
            'address_helper'                 => ' ',
            'tiktok'                         => 'Tiktok',
            'tiktok_helper'                  => ' ',
            'youtube'                        => 'Youtube',
            'youtube_helper'                 => ' ',
            'keywords_seo'                        => 'keywords Seo',
            'keywords_seo_helper'                 => ' ',
            'author_seo'                        => 'author Seo',
            'author_seo_helper'                 => ' ',
            'sitemap_link_seo'                        => 'sitemap Link Seo',
            'sitemap_link_seo_helper'                 => ' ',
            'description_seo'                        => 'description Seo',
            'description_seo_helper'                 => ' ',
            'supporters'                     => 'Supporters',
            'supporters_helper'              => ' ',
            'why_us'                     => 'why Us',
            'why_us_helper'              => ' ',
            'our_mission'                     => 'our Mission',
            'our_mission_helper'              => ' ',
            'contact_description'            => 'Contact Description',
            'contact_description_helper'     => ' ',
        ],
    ],
    'mainLink' => [
        'title'          => 'Main Links',
        'title_singular' => 'Main Link',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'photo'             => 'Photo',
            'photo_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'category'          => 'Category',
            'category_helper'   => ' ',
        ],
    ],
    'faqManagement' => [
        'title'          => 'FAQ Management',
        'title_singular' => 'FAQ Management',
    ],
    'faqCategory' => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'Category',
            'category_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'faqQuestion' => [
        'title'          => 'Questions',
        'title_singular' => 'Question',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'Category',
            'category_helper'   => ' ',
            'question'          => 'Question',
            'question_helper'   => ' ',
            'answer'            => 'Answer',
            'answer_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'productCategory' => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'photo'              => 'Photo',
            'photo_helper'       => ' ',
            'meta_title'              => 'meta Title',
            'meta_title_helper'       => ' ',
            'meta_description'              => 'meta Description',
            'meta_description_helper'       => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'userLink' => [
        'title'          => 'User Links',
        'title_singular' => 'User Link',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'main_link'         => 'Main Link',
            'main_link_helper'  => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'link'              => 'Link',
            'link_helper'       => ' ',
            'active'            => 'Active',
            'active_helper'     => ' ',
            'photo'             => 'Photo',
            'photo_helper'      => ' ',
        ],
    ],
    'order' => [
        'title'          => 'Orders',
        'title_singular' => 'Order',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'order_num'                      => 'order Num',
            'order_num_helper'               => ' ',
            'first_name'              => 'First Name',
            'first_name_helper'       => ' ',
            'last_name'               => 'Last Name',
            'last_name_helper'        => ' ',
            'phone_number'            => 'Phone Number',
            'phone_number_helper'     => ' ',
            'shipping_address'        => 'Shipping Address',
            'shipping_address_helper' => ' ',
            'total_price'             => 'Total Price',
            'total_price_helper'      => ' ',
            'shipping_cost'             => 'Shipping Price',
            'shipping_cost_helper'      => ' ',
            'delivery_status'         => 'Delivery Status',
            'delivery_status_helper'  => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'user'                    => 'User',
            'user_helper'             => ' ',
            'products'                => 'Products',
            'products_helper'         => ' ',
        ],
    ],
    'linkCategory' => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'Category',
            'category_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'review' => [
        'title'          => 'Reviews',
        'title_singular' => 'Review',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'review'            => 'Review',
            'review_helper'     => ' ',
            'rate'              => 'Rate',
            'rate_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'connection' => [
        'title'          => 'Connections',
        'title_singular' => 'Connection',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'name'                => 'Name',
            'name_helper'         => ' ',
            'email'               => 'Email',
            'email_helper'        => ' ',
            'title'               => 'Title',
            'title_helper'        => ' ',
            'phone_number'        => 'Phone Number',
            'phone_number_helper' => ' ',
            'photo'               => 'Photo',
            'photo_helper'        => ' ',
            'link'                => 'Link',
            'link_helper'         => ' ',
            'message'                => 'Message',
            'message_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'user'                => 'User',
            'user_helper'         => ' ',
        ],
    ],
    'country' => [
        'title'          => 'Countries',
        'title_singular' => 'Country',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'cost'              => 'Cost',
            'cost_helper'       => ' ',
            'code'              => 'Code',
            'code_helper'       => ' ',
            'code_cost'         => 'Code Cost',
            'code_cost_helper'  => ' ',
            'type'              => 'Type',
            'type_helper'       => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'tutorial' => [
        'title'          => 'Tutorials',
        'title_singular' => 'Tutorial',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'iframe'            => 'Iframe',
            'iframe_helper'     => 'Iframe from Youtube',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'subscribe' => [
        'title'          => 'Subscribe',
        'title_singular' => 'Subscribe',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'email'             => 'Email',
            'email_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'contactu' => [
        'title'          => 'Contactus',
        'title_singular' => 'Contactu',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'name'                => 'Name',
            'name_helper'         => ' ',
            'email'               => 'Email',
            'email_helper'        => ' ',
            'phone_number'        => 'Phone Number',
            'phone_number_helper' => ' ',
            'subject'             => 'Subject',
            'subject_helper'      => ' ',
            'message'             => 'Message',
            'message_helper'      => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
        ],
    ],
    'menuManagment' => [
        'title'          => 'Menu Managment',
        'title_singular' => 'Menu Managment',
    ],
    'menuClient' => [
        'title'          => 'Clients',
        'title_singular' => 'Client',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'logo'              => 'Logo',
            'logo_helper'       => ' ',
            'about_us'          => 'About Us',
            'about_us_helper'   => ' ',
            'facebook'          => 'Facebook',
            'facebook_helper'   => ' ',
            'twitter'           => 'Twitter',
            'twitter_helper'    => ' ',
            'google'            => 'Google',
            'google_helper'     => ' ',
            'linkedin'          => 'Linkedin',
            'linkedin_helper'   => ' ',
            'tiktok'            => 'Tiktok',
            'tiktok_helper'     => ' ',
            'youtube'           => 'Youtube',
            'youtube_helper'    => ' ',
            'instagram'         => 'Instagram',
            'instagram_helper'  => ' ',
            'whatsapp'          => 'Whatsapp',
            'whatsapp_helper'   => ' ',
        ],
    ],
    'menuPackage' => [
        'title'          => 'Packages',
        'title_singular' => 'Package',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'descrption'        => 'Descrption',
            'descrption_helper' => ' ',
            'price'             => 'Price',
            'price_helper'      => ' ',
            'menus'             => 'Menus',
            'menus_helper'      => 'Number of menus allowed',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'themes'            => 'Themes',
            'themes_helper'     => ' ',
        ],
    ],
    'menuTheme' => [
        'title'          => 'Themes',
        'title_singular' => 'Theme',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'menuClientPackage' => [
        'title'          => 'Client Package',
        'title_singular' => 'Client Package',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'menu_client'         => 'Menu Client',
            'menu_client_helper'  => ' ',
            'menu_package'        => 'Menu Package',
            'menu_package_helper' => ' ',
            'start_at'            => 'Start At',
            'start_at_helper'     => ' ',
            'end_at'              => 'End At',
            'end_at_helper'       => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
        ],
    ],
    'menuClientList' => [
        'title'          => 'Menu Client List',
        'title_singular' => 'Menu Client List',
        'fields'         => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'menu_theme'        => 'Menu Theme',
            'menu_theme_helper' => ' ',
            'logo'                       => 'Logo',
            'logo_helper'                => ' ',
            'about_us'                   => 'About Us',
            'about_us_helper'            => ' ',
            'facebook'                   => 'Facebook',
            'facebook_helper'            => ' ',
            'twitter'                    => 'Twitter',
            'twitter_helper'             => ' ',
            'google'                     => 'Google',
            'google_helper'              => ' ',
            'linkedin'                   => 'Linkedin',
            'linkedin_helper'            => ' ',
            'tiktok'                     => 'Tiktok',
            'tiktok_helper'              => ' ',
            'youtube'                    => 'Youtube',
            'youtube_helper'             => ' ',
            'instagram'                  => 'Instagram',
            'instagram_helper'           => ' ',
            'whatsapp'                   => 'Whatsapp',
            'whatsapp_helper'            => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
            'menu_client'                => 'Menu Client',
            'menu_client_helper'         => ' ',
            'categories'                => 'Categories',
            'categories_helper'         => ' ',
            'active'                => 'Active',
            'active_helper'         => ' ',
            'link'                => 'Link',
            'link_helper'         => '* should start with alphabets , all othe characters can be alphabets, numbers or underscore , lenght 4-30 characters *',
            'title'                => 'Title',
            'title_helper'         => ' ',
            'font_family'                => 'Font',
            'font_family_helper'         => ' ',
            'background'                => 'Background Image',
            'background_helper'         => ' ',
            'font_color'                => 'Font Color',
            'font_color_helper'         => ' ',
            'header_color'                => 'Header Color',
            'header_color_helper'         => ' ',
            'logo_size'                => 'Logo Size',
            'logo_size_helper'         => ' ',
            'header_size'                => 'Header Size',
            'header_size_helper'         => ' ',
        ],
    ],
    'menuCategory' => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'name'                    => 'Name',
            'name_helper'             => ' ',
            'banner'                  => 'Banner',
            'banner_helper'           => ' ',
            'menu_client_list'        => 'Menu Client List',
            'menu_client_list_helper' => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'menu_client'             => 'Menu Client',
            'menu_client_helper'      => ' ',
        ],
    ],
    'menuProduct' => [
        'title'          => 'Products',
        'title_singular' => 'Product',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'name'                 => 'Name',
            'name_helper'          => ' ',
            'price'                => 'Price',
            'price_helper'         => ' ',
            'description'                => 'Description',
            'description_helper'         => ' ',
            'menu_category'        => 'Menu Category',
            'menu_category_helper' => ' ',
            'menu_client'          => 'Menu Client',
            'menu_client_helper'   => ' ',
            'banner'                  => 'Banner',
            'banner_helper'           => ' ',
            'photos'                  => 'Photos',
            'photos_helper'           => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],


];
