import Chart from 'chart.js/auto';

const DASHBOARD = {
    init() {
        this.buildChartByMonths();
        this.buildChartByBudgets()
    },

    buildChartByMonths() {
        const ctx = document.getElementById('chart-by-months');

        console.log(CHART_BY_MONTHS);

        const data = {
            labels: CHART_BY_MONTHS.labels,
            datasets: [
              {
                label: 'Thu',
                data: CHART_BY_MONTHS.in,
                backgroundColor: "#28a745",
              },
              {
                label: 'Chi',
                data: CHART_BY_MONTHS.out,
                backgroundColor: "#dc3545",
              }
            ]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
              plugins: {
                title: {
                  display: true,
                  text: 'Thu Chi Từng Tháng Của Năm 2023'
                },
              },
              responsive: true,
              scales: {
                x: {
                  stacked: true,
                },
                y: {
                  stacked: true
                }
              }
            }
        };
          

        new Chart(ctx, config);
    },

    buildChartByBudgets() {
        const ctx = document.getElementById('chart-by-budgets');

        const data = {
            labels: [1,2,3,4,5,6,7],
            datasets: [
              {
                label: 'Ngân Sách',
                data: [2,4,6,8,10,12,14],
                backgroundColor: "#28a745",
                stack: '0',
              },
              {
                label: 'Đã Chi',
                data: [1,2,3,4,5,6,7],
                backgroundColor: "#dc3545",
                stack: '1',
              }
            ]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
              plugins: {
                title: {
                  display: true,
                  text: 'Ngân Sách Tháng 12'
                },
              },
              responsive: true,
              scales: {
                x: {
                  stacked: true,
                },
                y: {
                  stacked: true,
                }
              }
            }
        };
          

        new Chart(ctx, config);
    }
}

$(document).ready(function () {
    DASHBOARD.init();
});
