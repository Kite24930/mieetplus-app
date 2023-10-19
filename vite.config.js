import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        https: true,
    },
    build: {
        manifest: true,
        rollupOptions: {
            input: {
                appCss: 'resources/css/app.css',
                app: 'resources/js/app.js',
                auth: 'resources/js/auth.js',
                authCss: 'resources/css/auth.css',
                register: 'resources/js/auth/register.js',
                index: 'resources/js/index.js',
                indexCss: 'resources/css/index.css',
                termsPolicy: 'resources/js/terms_policy.js',
                termsPolicyCss: 'resources/css/terms_policy.css',
                contact: 'resources/js/contact.js',
                contactCss: 'resources/css/contact.css',
                contactSuccess: 'resources/js/contact-success.js',
                recruit: 'resources/js/recruit/recruit.js',
                recruitCss: 'resources/css/recruit/recruit.css',
                companyDetail: 'resources/js/recruit/companyDetail.js',
                companyDetailCss: 'resources/css/recruit/detail.css',
                dashboard: 'resources/js/dashboard/dashboard.js',
                dashboardCss: 'resources/css/dashboard/dashboard.css',
                companyList: 'resources/js/dashboard/companyList.js',
                companyListCss: 'resources/css/dashboard/companyList.css',
                companyAdd: 'resources/js/dashboard/companyAdd.js',
                adminCompanyDetail: 'resources/js/dashboard/adminCompanyDetail.js',
                adminCompanyDetailCss: 'resources/css/dashboard/companyDetail.css',
                adminCompanyEdit: 'resources/js/dashboard/adminCompanyEdit.js',
                studentList: 'resources/js/dashboard/studentList.js',
                studentDetail: 'resources/js/dashboard/studentDetail.js',
                companyDashboardDetail: 'resources/js/dashboard/company/companyDetail.js',
                companyDepartment: 'resources/js/dashboard/company/companyDepartment.js',
                companyDetailEdit: 'resources/js/dashboard/company/companyDetailEdit.js',
                followersList: 'resources/js/dashboard/company/followersList.js',
                companySetting: 'resources/js/dashboard/company/companySetting.js',
                companySettingCss: 'resources/css/dashboard/companySetting.css',
                studentProfile: 'resources/js/profile/studentProfile.js',
                studentProfileCss: 'resources/css/profile/studentProfile.css',
                studentProfileEdit: 'resources/js/profile/studentProfileEdit.js',
                followed: 'resources/js/recruit/followed.js',
                followedCss: 'resources/css/recruit/followed.css',
                search: 'resources/js/recruit/search.js',
                searchCss: 'resources/css/recruit/search.css',
            }
        }
    }
});
