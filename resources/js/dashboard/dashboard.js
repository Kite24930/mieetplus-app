import 'bootstrap-icons/font/bootstrap-icons.css';
import '../app.js';
import '../../css/dashboard/dashboard.css';
import 'flowbite';
import Chart from 'chart.js/auto';

console.log(Laravel);
// Chart.js
Laravel.companies.forEach(company => {
    const sex = document.getElementById(`sex-${company.id}`);
    let sexData = [];
    Object.keys(Laravel.sex[company.id]).forEach((value, index) => {
        sexData.push(Laravel.sex[company.id][value]);
    });
    const sexConfig = {
        type: 'doughnut',
        data: {
            labels: [
                '男性',
                '女性',
                'その他',
                '非回答',
            ],
            datasets: [{
                data: sexData,
                radius: 100,
            }]
        },
        options: {
            animation: {
                duration: 0,
            },
            plugins: {
                legend: {
                    display: false,
                },
                title: {
                    display: true,
                    text: '性別',
                }
            }
        },
        plugins: [],
    }
    const sexChart = new Chart(sex, sexConfig);

    const faculties = document.getElementById(`faculties-${company.id}`);
    const facultiesData = [];
    Object.keys(Laravel.faculties[company.id]).forEach((value, index) => {
        facultiesData.push(Laravel.faculties[company.id][value]);
    });
    let facultiesLabels = [];
    Object.keys(Laravel.faculties_list).forEach((value, index) => {
        facultiesLabels.push(value);
    });
    const facultiesConfig = {
        type: 'doughnut',
        data: {
            labels: facultiesLabels,
            datasets: [{
                data: facultiesData,
                radius: 100,
            }],
        },
        options: {
            animation: {
                duration: 0,
            },
            plugins: {
                legend: {
                    display: false,
                },
                title: {
                    display: true,
                    text: '学部・研究科',
                }
            }
        },
    }
    const facultiesChart = new Chart(faculties, facultiesConfig);

    Object.keys(Laravel.faculties_list).forEach(faculty_key => {
        const facultySex = document.getElementById(`${Laravel.faculties_list[faculty_key]}-sex-${company.id}`);
        const facultySexData = [];
        Object.keys(Laravel.faculty_sex[company.id][faculty_key]).forEach((value, index) => {
            facultySexData.push(Laravel.faculty_sex[company.id][faculty_key][value]);
        });
        const facultySexConfig = {
            type: 'doughnut',
            data: {
                labels: Laravel.sex_list,
                datasets: [{
                    data: facultySexData,
                    radius: 100,
                }]
            },
            options: {
                animation: {
                    duration: 0,
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: true,
                        text: '性別',
                    }
                }
            },
            plugins: [],
        }
        const facultySexChart = new Chart(facultySex, facultySexConfig);

        const facultyGrades = document.getElementById(`${Laravel.faculties_list[faculty_key]}-grade-${company.id}`);
        const facultyGradesData = [];
        Object.keys(Laravel.faculty_grades[company.id][faculty_key]).forEach((value, index) => {
            facultyGradesData.push(Laravel.faculty_grades[company.id][faculty_key][value]);
        });
        const facultyGradesConfig = {
            type: 'doughnut',
            data: {
                labels: Laravel.grades_list,
                datasets: [{
                    data: facultyGradesData,
                    radius: 100,
                }],
            },
            options: {
                animation: {
                    duration: 0,
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: true,
                        text: '学年',
                    }
                }
            },
            plugins: [],
        }
        const facultyGradesChart = new Chart(facultyGrades, facultyGradesConfig);
    });
})
