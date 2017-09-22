var assetLibrary = angular.module('assetLibrary', []);

assetLibrary.controller('assetList', function($scope) {
  $scope.folders = ["Images","HTML Emails","HTML Pages", "eBooks"];
  $scope.tags = ["Prospect content", "Client content", "Internal stuff", "Mac-only"];  
  $scope.files = [
    {
        Name: {
            fileName: 'http://s3.com/bucket-name/for-client/1.jpg',
            friendlyName: 'Header Image'
        },
        Thumbnail: "http://www.mindfireinc.com/static/images/david-rosendahl.jpg",
        Description: "Use this for any emails.  This is the only approved masthead that Kushal is OK with.",
        Type: "Image",
        Size: "20k",
        URI:  "http://s3.com/bucket-name/for-client/1.jpg",
    },
    {
        Name: {
            fileName: 'http://s3.com/bucket-name/for-client/2.jpg',
            friendlyName: 'Header 2 Image'
        },
        Thumbnail: "http://www.mindfireinc.com/static/images/david-rosendahl.jpg",      
        Description: "This one has teh classic Kush typo.  Do you see it?",
        Type: "Image",
        Size: "11k",
        URI:  "http://s3.com/bucket-name/for-client/bucket-name/for-client/2.jpg",
    },
    {
        Name: {
            fileName: 'http://s3.com/bucket-name/for-client/bucket-name/for-client/2.jpg',
            friendlyName: 'Header 2 Image'
        },
        Thumbnail: "http://www.mindfireinc.com/static/images/david-rosendahl.jpg",      
        Description: "Another image for use in the landing page.",
        Type: "Image",
        Size: "144k",
        URI:  "http://s3.com/bucket-name/for-client/bucket-name/for-client/2.jpg",
    },
    {
        Name: {
            fileName: 'http://s3.com/bucket-name/for-client/bucket-name/for-client/2.jpg',
            friendlyName: 'Header 2 Image'
        },
        Thumbnail: "http://www.mindfireinc.com/static/images/david-rosendahl.jpg",      
        Description: "First upload to Canva",
        Type: "Image",
        Size: "12k",
        URI:  "http://s3.com/bucket-name/for-client/bucket-name/for-client/2.jpg",
    },
    {
        Name: {
            fileName: 'http://s3.com/bucket-name/for-client/bucket-name/for-client/2.jpg',
            friendlyName: 'Header 2 Image'
        },
        Thumbnail: "http://www.mindfireinc.com/static/images/david-rosendahl.jpg",      
        Description: "Email masthead.",
        Type: "Image",
        Size: "144k",
        URI:  "http://s3.com/bucket-name/for-client/bucket-name/for-client/2.jpg",
    },
    {
        Name: {
            fileName: 'http://s3.com/bucket-name/for-client/bucket-name/for-client/2.jpg',
            friendlyName: 'Header 2 Image'
        },
        Thumbnail: "http://www.mindfireinc.com/static/images/david-rosendahl.jpg",      
        Description: "Frick.  This one is wrong.  Oh well",
        Type: "Image",
        Size: "18k",
        URI:  "http://s3.com/bucket-name/for-client/bucket-name/for-client/2.jpg",
    },
    {
        Name: {
            fileName: 'http://s3.com/bucket-name/for-client/bucket-name/for-client/2.jpg',
            friendlyName: 'Header 2 Image'
        },
        Thumbnail: "http://www.mindfireinc.com/static/images/david-rosendahl.jpg",      
        Description: "Great image.",
        Type: "Image",
        Size: "199k",
        URI:  "http://s3.com/bucket-name/for-client/bucket-name/for-client/2.jpg",
    }
    
  ];
});