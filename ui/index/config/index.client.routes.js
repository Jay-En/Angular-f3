angular.module('index').config(['$routeProvider',
	function($routeProvider) {
		$routeProvider.
			when('/', {
				templateUrl: '../../ui/index/views/index.client.view.html'
				}).
			otherwise({
				redirectTo: '/'
				});
			}
]);

