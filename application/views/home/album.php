<container ng-app="myApp">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div ng-controller="AlbumCtrl">
        <img src="//www.nganimate.org/img/angular-logo.png" alt="AngularJS Logo" class="angLogo"/>
        <h2>AngularJS Powered Photo Album <small>by Josh Adamous</small> </h2>
          <div class="row">
            <div class="col-md-9">
              <div class="albumImage">
                <img ng-src="{{currentImage.image}}" alt="{{currentImage.description}}"/>
              </div>
              <h3>{{currentImage.description}}</h3>
              <p class="badge"><span class="glyphicon glyphicon-star"></span>{{currentImage.stars}}</p>
              <select ng-model="categories"
                      ng-options="category for category in imageCategories">
                <option value="">All</option>
              </select>
              <label for="select">Select a Rating:</label>
            </div><!-- End of Column -->
            <div class="col-md-3">
              <div class="wrapper">
                <ul class="list">
                  <li ng-repeat="image in images | filter:categories" ng-click="setCurrentImage(image)">
                    <img ng-src="{{image.image}}" alt="{{image.description}}"/>
                  </li>
                </ul><!-- End of List -->
              </div><!-- End of Wrapper -->
            </div><!-- End of Column -->
          </div><!-- End of Row -->
        </div><!-- End of Album Controller -->
      </div><!-- End of Column -->
    </div><!-- End of Row -->
  </div><!-- End of Container -->
</container><!-- End of Body -->

<script>
angular.module('myApp', [])
.controller('AlbumCtrl', function($scope) {
  $scope.images = [
    {category : 'High', image : 'http://lorempixel.com/g/850/400', description : 'Random Photo', stars : '4/5'},
    {category : 'Medium', image : 'http://lorempixel.com/g/850/400/sports', description : 'Sports Photo', stars : '3/5'},
    {category : 'Medium', image : 'http://lorempixel.com/g/850/400/animals', description : 'Animal Photo', stars : '3/5'},
    {category : 'High', image : 'http://lorempixel.com/g/850/400/abstract', description : 'Abstract Photo', stars : '5/5'},
    {category : 'Low', image : 'http://lorempixel.com/g/850/400/business', description : 'Business Photo', stars : '1/5'},
    {category : 'High', image : 'http://lorempixel.com/g/850/400/cats', description : 'Cat Photo', stars : '4/5'},
    {category : 'Medium', image : 'http://lorempixel.com/g/850/400/city', description : 'City Photo', stars : '3/5'},
    {category : 'Low', image : 'http://lorempixel.com/g/850/400/fashion', description : 'Fashion Photo', stars : '2/5'},
    {category : 'High', image : 'http://lorempixel.com/g/850/400/nature', description : 'Nature Photo', stars : '5/5'}
  ];

  $scope.currentImage = _.first($scope.images);

  $scope.imageCategories = _.uniq(_.pluck($scope.images, 'category'));

  $scope.setCurrentImage = function(image) {
    $scope.currentImage = image;
  };
});
</script>
