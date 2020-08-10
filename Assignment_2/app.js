(function () {
    'use strict';
    angular.module('DatabaseApp',['ui.router']);

    angular.module('DatabaseApp')
    .config(RoutesConfig);

    RoutesConfig.$inject = ['$stateProvider','$urlRouterProvider']
    function RoutesConfig($stateProvider,$urlRouterProvider) {
        $urlRouterProvider.otherwise("/");

        $stateProvider
        .state('database',{
            abstract : true,
            templateUrl : 'database.html'
        })
        .state('database.add',{
            templateUrl : 'addDatabase.template.php',
            url : '/'
        })
        .state('database.show',{
            templateUrl : 'showdatabase.template.php',
            url :'/aritra"s database'
        });
    }
})();

/* <ul>
         <?php
            foreach ($rows as $row) {
                echo '<li>';
                echo htmlentities($row['make']) . ' ' . $row['year'] . ' / ' . $row['mileage'];
            };
            echo '</li><br/>';
        ?> 
    </ul> */