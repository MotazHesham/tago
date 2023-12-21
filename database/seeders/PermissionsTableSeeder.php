<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 21,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 22,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 23,
                'title' => 'product_managment_access',
            ],
            [
                'id'    => 24,
                'title' => 'product_create',
            ],
            [
                'id'    => 25,
                'title' => 'product_edit',
            ],
            [
                'id'    => 26,
                'title' => 'product_show',
            ],
            [
                'id'    => 27,
                'title' => 'product_delete',
            ],
            [
                'id'    => 28,
                'title' => 'product_access',
            ],
            [
                'id'    => 29,
                'title' => 'general_setting_access',
            ],
            [
                'id'    => 30,
                'title' => 'setting_create',
            ],
            [
                'id'    => 31,
                'title' => 'setting_edit',
            ],
            [
                'id'    => 32,
                'title' => 'setting_show',
            ],
            [
                'id'    => 33,
                'title' => 'setting_delete',
            ],
            [
                'id'    => 34,
                'title' => 'setting_access',
            ],
            [
                'id'    => 35,
                'title' => 'main_link_create',
            ],
            [
                'id'    => 36,
                'title' => 'main_link_edit',
            ],
            [
                'id'    => 37,
                'title' => 'main_link_show',
            ],
            [
                'id'    => 38,
                'title' => 'main_link_delete',
            ],
            [
                'id'    => 39,
                'title' => 'main_link_access',
            ],
            [
                'id'    => 40,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 41,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 42,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 43,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 44,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 45,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 46,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 47,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 48,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 49,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 50,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 51,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 52,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 53,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 54,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 55,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 56,
                'title' => 'user_link_create',
            ],
            [
                'id'    => 57,
                'title' => 'user_link_edit',
            ],
            [
                'id'    => 58,
                'title' => 'user_link_show',
            ],
            [
                'id'    => 59,
                'title' => 'user_link_delete',
            ],
            [
                'id'    => 60,
                'title' => 'user_link_access',
            ],
            [
                'id'    => 61,
                'title' => 'order_create',
            ],
            [
                'id'    => 62,
                'title' => 'order_edit',
            ],
            [
                'id'    => 63,
                'title' => 'order_show',
            ],
            [
                'id'    => 64,
                'title' => 'order_delete',
            ],
            [
                'id'    => 65,
                'title' => 'order_access',
            ],
            [
                'id'    => 66,
                'title' => 'link_category_create',
            ],
            [
                'id'    => 67,
                'title' => 'link_category_edit',
            ],
            [
                'id'    => 68,
                'title' => 'link_category_show',
            ],
            [
                'id'    => 69,
                'title' => 'link_category_delete',
            ],
            [
                'id'    => 70,
                'title' => 'link_category_access',
            ],
            [
                'id'    => 71,
                'title' => 'review_create',
            ],
            [
                'id'    => 72,
                'title' => 'review_edit',
            ],
            [
                'id'    => 73,
                'title' => 'review_show',
            ],
            [
                'id'    => 74,
                'title' => 'review_delete',
            ],
            [
                'id'    => 75,
                'title' => 'review_access',
            ],
            [
                'id'    => 76,
                'title' => 'connection_create',
            ],
            [
                'id'    => 77,
                'title' => 'connection_edit',
            ],
            [
                'id'    => 78,
                'title' => 'connection_show',
            ],
            [
                'id'    => 79,
                'title' => 'connection_delete',
            ],
            [
                'id'    => 80,
                'title' => 'connection_access',
            ],
            [
                'id'    => 81,
                'title' => 'country_create',
            ],
            [
                'id'    => 82,
                'title' => 'country_edit',
            ],
            [
                'id'    => 83,
                'title' => 'country_show',
            ],
            [
                'id'    => 84,
                'title' => 'country_delete',
            ],
            [
                'id'    => 85,
                'title' => 'country_access',
            ],
            [
                'id'    => 86,
                'title' => 'tutorial_create',
            ],
            [
                'id'    => 87,
                'title' => 'tutorial_edit',
            ],
            [
                'id'    => 88,
                'title' => 'tutorial_show',
            ],
            [
                'id'    => 89,
                'title' => 'tutorial_delete',
            ],
            [
                'id'    => 90,
                'title' => 'tutorial_access',
            ],
            [
                'id'    => 91,
                'title' => 'subscribe_create',
            ],
            [
                'id'    => 92,
                'title' => 'subscribe_edit',
            ],
            [
                'id'    => 93,
                'title' => 'subscribe_show',
            ],
            [
                'id'    => 94,
                'title' => 'subscribe_delete',
            ],
            [
                'id'    => 95,
                'title' => 'subscribe_access',
            ],
            [
                'id'    => 96,
                'title' => 'contactu_create',
            ],
            [
                'id'    => 97,
                'title' => 'contactu_edit',
            ],
            [
                'id'    => 98,
                'title' => 'contactu_show',
            ],
            [
                'id'    => 99,
                'title' => 'contactu_delete',
            ],
            [
                'id'    => 100,
                'title' => 'contactu_access',
            ],
            [
                'id'    => 101,
                'title' => 'menu_managment_access',
            ],
            [
                'id'    => 102,
                'title' => 'menu_client_create',
            ],
            [
                'id'    => 103,
                'title' => 'menu_client_edit',
            ],
            [
                'id'    => 104,
                'title' => 'menu_client_show',
            ],
            [
                'id'    => 105,
                'title' => 'menu_client_delete',
            ],
            [
                'id'    => 106,
                'title' => 'menu_client_access',
            ],
            [
                'id'    => 107,
                'title' => 'menu_package_create',
            ],
            [
                'id'    => 108,
                'title' => 'menu_package_edit',
            ],
            [
                'id'    => 109,
                'title' => 'menu_package_show',
            ],
            [
                'id'    => 110,
                'title' => 'menu_package_delete',
            ],
            [
                'id'    => 111,
                'title' => 'menu_package_access',
            ],
            [
                'id'    => 112,
                'title' => 'menu_theme_access',
            ],
            [
                'id'    => 113,
                'title' => 'menu_client_package_create',
            ],
            [
                'id'    => 114,
                'title' => 'menu_client_package_edit',
            ],
            [
                'id'    => 115,
                'title' => 'menu_client_package_show',
            ],
            [
                'id'    => 116,
                'title' => 'menu_client_package_delete',
            ],
            [
                'id'    => 117,
                'title' => 'menu_client_package_access',
            ],
            [
                'id'    => 118,
                'title' => 'menu_client_list_create',
            ],
            [
                'id'    => 119,
                'title' => 'menu_client_list_edit',
            ],
            [
                'id'    => 120,
                'title' => 'menu_client_list_show',
            ],
            [
                'id'    => 121,
                'title' => 'menu_client_list_delete',
            ],
            [
                'id'    => 122,
                'title' => 'menu_client_list_access',
            ],
            [
                'id'    => 123,
                'title' => 'menu_category_create',
            ],
            [
                'id'    => 124,
                'title' => 'menu_category_edit',
            ],
            [
                'id'    => 125,
                'title' => 'menu_category_show',
            ],
            [
                'id'    => 126,
                'title' => 'menu_category_delete',
            ],
            [
                'id'    => 127,
                'title' => 'menu_category_access',
            ],
            [
                'id'    => 128,
                'title' => 'menu_product_create',
            ],
            [
                'id'    => 129,
                'title' => 'menu_product_edit',
            ],
            [
                'id'    => 130,
                'title' => 'menu_product_show',
            ],
            [
                'id'    => 131,
                'title' => 'menu_product_delete',
            ],
            [
                'id'    => 132,
                'title' => 'menu_product_access',
            ],
            [
                'id'    => 133,
                'title' => 'templates_mangment_access',
            ],
            [
                'id'    => 134,
                'title' => 'template_create',
            ],
            [
                'id'    => 135,
                'title' => 'template_edit',
            ],
            [
                'id'    => 136,
                'title' => 'template_show',
            ],
            [
                'id'    => 137,
                'title' => 'template_delete',
            ],
            [
                'id'    => 138,
                'title' => 'template_access',
            ],
            [
                'id'    => 139,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
