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
                index: 'resources/js/index.js',
                recruit: 'resources/js/recruit/recruit.js',
                companyDetail: 'resources/js/recruit/companyDetail.js',
                dashboard: 'resources/js/dashboard/dashboard.js',
                companyList: 'resources/js/dashboard/companyList.js',
                companyAdd: 'resources/js/dashboard/companyAdd.js',
                adminCompanyDetail: 'resources/js/dashboard/adminCompanyDetail.js',
                adminCompanyEdit: 'resources/js/dashboard/adminCompanyEdit.js',
                studentList: 'resources/js/dashboard/studentList.js',
                studentDetail: 'resources/js/dashboard/studentDetail.js',
                companyDashboardDetail: 'resources/js/dashboard/company/companyDetail.js',
                companyDetailEdit: 'resources/js/dashboard/company/companyDetailEdit.js',
                followersList: 'resources/js/dashboard/company/followersList.js',
                companySetting: 'resources/js/dashboard/company/companySetting.js',
                studentProfile: 'resources/js/profile/studentProfile.js',
                studentProfileEdit: 'resources/js/profile/studentProfileEdit.js',
                followed: 'resources/js/recruit/followed.js',
                search: 'resources/js/recruit/search.js',
            }
        }
    }
});
