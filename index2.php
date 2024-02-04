<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Highcharts Treegraph</title>
  <!-- Incluir la biblioteca Highcharts -->
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/treemap.js"></script>
  <script src="https://code.highcharts.com/modules/treegraph.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
  <style>
    /* Puedes agregar estilos adicionales según sea necesario */
    #container {
      max-width: 100%;
      height: auto;
      margin: 0 auto;
    }
  </style>
</head>
<body>

  <!-- Contenedor para el gráfico Highcharts -->
  <div id="container"></div>

  <script>
 const data = [
    {
        id: '0.0',
        parent: '',
        name: 'The World'
    },
    {
        id: '1.3',
        parent: '0.0',
        name: 'Asia'
    },
    {
        id: '1.1',
        parent: '0.0',
        name: 'Africa'
    },
    {
        id: '1.2',
        parent: '0.0',
        name: 'America'
    },
    {
        id: '1.4',
        parent: '0.0',
        name: 'Europe'
    },
    {
        id: '1.5',
        parent: '0.0',
        name: 'Oceanic'
    },

    /* Africa */
    {
        id: '2.1',
        parent: '1.1',
        name: 'Eastern Africa'
    },

    {
        id: '2.5',
        parent: '1.1',
        name: 'Western Africa'
    },
   {
        id: '222.5',
        parent: '2.5',
        name: '2222'
    },

    {
        id: '2.3',
        parent: '1.1',
        name: 'North Africa'
    },

    {
        id: '2.2',
        parent: '1.1',
        name: 'Central Africa'
    },

    {
        id: '2.4',
        parent: '1.1',
        name: 'South America'
    },

    /* America */
    {
        id: '2.9',
        parent: '1.2',
        name: 'South America'
    },

    {
        id: '2.8',
        parent: '1.2',
        name: 'Northern America'
    },

    {
        id: '2.7',
        parent: '1.2',
        name: 'Central America'
    },

    {
        id: '2.6',
        parent: '1.2',
        name: 'Caribbean'
    },

    /* Asia */
    {
        id: '2.13',
        parent: '1.3',
        name: 'Southern Asia'
    },

    {
        id: '2.11',
        parent: '1.3',
        name: 'Eastern Asia'
    },

    {
        id: '2.12',
        parent: '1.3',
        name: 'South-Eastern Asia'
    },

    {
        id: '2.14',
        parent: '1.3',
        name: 'Western Asia'
    },

    {
        id: '2.10',
        parent: '1.3',
        name: 'Central Asia'
    },

    /* Europe */
    {
        id: '2.15',
        parent: '1.4',
        name: 'Eastern Europe'
    },

    {
        id: '2.16',
        parent: '1.4',
        name: 'Northern Europe'
    },

    {
        id: '2.17',
        parent: '1.4',
        name: 'Southern Europe'
    },

    {
        id: '2.18',
        parent: '1.4',
        name: 'Western Europe'
    },
    /* Oceania */
    {
        id: '2.19',
        parent: '1.5',
        name: 'Australia and New Zealand'
    },

    {
        id: '2.20',
        parent: '1.5',
        name: 'Melanesia'
    },

    {
        id: '2.21',
        parent: '1.5',
        name: 'Micronesia'
    },

    {
        id: '2.22',
        parent: '1.5',
        name: 'Polynesia'
    }
];
    Highcharts.chart('container', {
      chart: {
        inverted: true,
        marginBottom: 170,
        height: '100%', // Añadido para hacerlo responsivo
        events: {
          load: function () {
            this.reflow(); // Añadido para hacerlo responsivo
          }
        }
      },
      title: {
        text: 'Inverted treegraph',
        align: 'left'
      },
      series: [
        {
          type: 'treegraph',
          data,
          tooltip: {
            pointFormat: '{point.name}'
          },
          dataLabels: {
            pointFormat: '{point.name}',
            style: {
              whiteSpace: 'nowrap',
              color: '#000000',
              textOutline: '3px contrast'
            },
            crop: false
          },
          marker: {
            radius: 6
          },
          levels: [
            {
              level: 1,
              dataLabels: {
                align: 'left',
                x: 20
              }
            },
            {
              level: 2,
              colorByPoint: true,
              dataLabels: {
                verticalAlign: 'bottom',
                y: -20
              }
            },
            {
              level: 3,
              colorByPoint: true,
              dataLabels: {
                verticalAlign: 'bottom',
                y: -20
              }
            },
            {
              level: 4,
              colorByPoint: true,
              dataLabels: {
                verticalAlign: 'bottom',
                y: -20
              }
            },
          ]
        }
      ]
    });
  </script>

</body>
</html>
