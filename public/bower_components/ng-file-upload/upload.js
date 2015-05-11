'use strict';


var app = angular.module('fileUpload', [ 'ngFileUpload' ]);
var version = '4.1.2';

app.controller('MyCtrl', [ '$scope', '$http', '$timeout', '$compile', 'Upload', function($scope, $http, $timeout, $compile, Upload) {

	$scope.uploadPic = function(files) {
		$scope.formUpload = true;
        console.log(files[0]);
		if (files != null) {
            uploadUsingUpload(files[0])
		}
	};
	

	
	function uploadUsingUpload(file) {

       file.upload = Upload.upload({
			url: 'upload.php',
			method: 'POST',
			headers: {
				'my-header' : 'my-header-value'
			},
			fields: {username: $scope.username},
			file: file,
			fileFormDataName: 'myFile'
		});

		file.upload.then(function(response) {
			$timeout(function() {
				file.result = response.data;
			});
		}, function(response) {
			if (response.status > 0)
				$scope.errorMsg = response.status + ': ' + response.data;
		});

		file.upload.progress(function(evt) {
			// Math.min is to fix IE which reports 200% sometimes
			file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
		});

		file.upload.xhr(function(xhr) {
			// xhr.upload.addEventListener('abort', function(){console.log('abort complete')}, false);
		});
	}




} ]);
