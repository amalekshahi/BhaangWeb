var assetLibrary = angular.module('assetLibrary', []);

assetLibrary.controller('assetList', function($scope) {
  $scope.showPreview = function(file) {
    //alert(file);
    $scope.showPreviewFile = file;
  };
  $scope.folders = ["Images","HTML Emails","HTML Pages", "eBooks"];
  $scope.tags = ["Prospect content", "Client content", "Internal stuff", "Mac-only"];  
  $scope.files = [
    {
        Name: {
            fileName: 'http://mthink.com/legacy/www.crmproject.com/assets/images/CRM6_sp_seller_hamilton.gif',
            friendlyName: 'Header Image'
        },
        Thumbnail: "http://mthink.com/legacy/www.crmproject.com/assets/images/CRM6_sp_seller_hamilton.gif",
        Description: "Use this for any emails.  This is the only approved masthead that Kushal is OK with.",
        Type: "Image",
        Size: "20k",
        URI:  "http://s3.com/bucket-name/for-client/1.jpg",
        Dimensions: "105 x 71",
    },
    {
        Name: {
            fileName: 'http://katcoles.com/files/email_masthead1.jpg',
            friendlyName: 'Header 2 Image'
        },
        Thumbnail: "http://katcoles.com/files/email_masthead1.jpg",      
        Description: "This one has teh classic Kush typo.  Do you see it?",
        Type: "Image",
        Size: "11k",
        URI:  "http://s3.com/bucket-name/for-client/bucket-name/for-client/2.jpg",
        Dimensions: "305 x 71",

    },
    {
        Name: {
            fileName: 'https://www.leadpages.net/assets/imgs/_rebrand/landing-pages.jpg',
            friendlyName: 'Header 2 Image'
        },
        Thumbnail: "https://www.leadpages.net/assets/imgs/_rebrand/landing-pages.jpg",      
        Description: "Another image for use in the landing page.",
        Type: "Image",
        Size: "144k",
        URI:  "https://www.leadpages.net/assets/imgs/_rebrand/landing-pages.jpg",
        Dimensions: "15 x 71",      
    },
    {
        Name: {
            fileName: 'https://cdn.elegantthemes.com/blog/wp-content/uploads/2016/01/WordPress-eBooks-FT-shutterstock_298676606-adichrisworo.png',
            friendlyName: 'Header 2 Image'
        },
        Thumbnail: "https://cdn.elegantthemes.com/blog/wp-content/uploads/2016/01/WordPress-eBooks-FT-shutterstock_298676606-adichrisworo.png",      
        Description: "First upload to Canva",
        Type: "Image",
        Size: "12k",
        URI:  "https://cdn.elegantthemes.com/blog/wp-content/uploads/2016/01/WordPress-eBooks-FT-shutterstock_298676606-adichrisworo.png",
        Dimensions: "16 x 789",

    },
    {
        Name: {
            fileName: 'http://wwwimages.adobe.com/content/dam/Adobe/en/products/content-server/images/publisher.jpg',
            friendlyName: 'Header 2 Image'
        },
        Thumbnail: "http://wwwimages.adobe.com/content/dam/Adobe/en/products/content-server/images/publisher.jpg",      
        Description: "Email masthead.",
        Type: "Image",
        Size: "144k",
        URI:  "http://wwwimages.adobe.com/content/dam/Adobe/en/products/content-server/images/publisher.jpg",
    },
    {
        Name: {
            fileName: 'https://speckyboy.com/wp-content/uploads/2016/12/free_ebook_2014_02.jpg',
            friendlyName: 'Header 2 Image'
        },
        Thumbnail: "https://speckyboy.com/wp-content/uploads/2016/12/free_ebook_2014_02.jpg",      
        Description: "Frick.  This one is wrong.  Oh well",
        Type: "Image",
        Size: "18k",
        URI:  "https://speckyboy.com/wp-content/uploads/2016/12/free_ebook_2014_02.jpg",
    },
    {
        Name: {
            fileName: 'https://ebooklaunch.com/wp-content/uploads/2017/01/ebooklaunch_profilepic-2016_instagram.jpeg',
            friendlyName: 'Header 2 Image'
        },
        Thumbnail: "https://ebooklaunch.com/wp-content/uploads/2017/01/ebooklaunch_profilepic-2016_instagram.jpeg",      
        Description: "Great image.",
        Type: "Image",
        Size: "199k",
        URI:  "https://ebooklaunch.com/wp-content/uploads/2017/01/ebooklaunch_profilepic-2016_instagram.jpeg",
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
    },
        {
        Name: {
            fileName: 'http://pad1.whstatic.com/images/thumb/4/41/Choose-an-eBook-Reader-Step-1-Version-2.jpg/aid1119390-v4-728px-Choose-an-eBook-Reader-Step-1-Version-2.jpg',
            friendlyName: 'Header 2 Image'
        },
        Thumbnail: "http://pad1.whstatic.com/images/thumb/4/41/Choose-an-eBook-Reader-Step-1-Version-2.jpg/aid1119390-v4-728px-Choose-an-eBook-Reader-Step-1-Version-2.jpg",      
        Description: "Great image.",
        Type: "Image",
        Size: "199k",
        URI:  "http://pad1.whstatic.com/images/thumb/4/41/Choose-an-eBook-Reader-Step-1-Version-2.jpg/aid1119390-v4-728px-Choose-an-eBook-Reader-Step-1-Version-2.jpg",
    }


    
  ];
});