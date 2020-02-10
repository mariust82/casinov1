function SearchTracker(item) {
    if(typeof dataLayer == 'undefined'){
        return;
    }

    var _trackerObject = {
        'event': 'search',
        'Category': 'UserSearch'
    };

    _trackerObject['item'] = item;
    console.log(_trackerObject);
    send(_trackerObject);

    function send(obj) {
        dataLayer.push(obj);
    }
}