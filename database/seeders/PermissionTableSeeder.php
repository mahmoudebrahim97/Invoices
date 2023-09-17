<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            'الفواتير',

            'قائمة الفواتير',
            'اضافة فاتورة',
            'عمليات الفاتورة',
            'تغير حالة الدفع',
            'تعديل الفاتورة',
            'ارشفة الفاتورة',
            'طباعة الفاتورة',
            'حذف الفاتورة',
            'اضافة مرفق',
            'حذف المرفق',
            'تصدير EXCEL',

            'الفواتير المدفوعة',
            'الفواتير المدفوعة جزئيا',
            'الفواتير الغير مدفوعة',
            'ارشيف الفواتير',

            'التقارير',
            'تقرير الفواتير',
            'تقرير العملاء',

            'المستخدمين',

            'قائمة المستخدمين',
            'عمليات المستخدم',
            'اضافة مستخدم',
            'تعديل مستخدم',
            'حذف مستخدم',

            'صلاحيات المستخدمين',
            'العمليات علي الصلاحيه',
            'عرض صلاحية',
            'اضافة صلاحية',
            'تعديل صلاحية',
            'حذف صلاحية',

            'الاعدادات',

            'الاقسام',
            'عمليات القسم',
            'اضافة قسم',
            'تعديل قسم',
            'حذف قسم',

            'المنتجات',
            'عمليات المنتج',
            'اضافة منتج',
            'تعديل منتج',
            'حذف منتج',

            'الاشعارات',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}