## AtansCommon

Master: [![Build Status](https://secure.travis-ci.org/atans/AtansCommon.png?branch=master)](http://travis-ci.org/atans/AtansCommon)

The Atans library

## Ajax contoller plugin
```php
    public function textAction()
    {
        // Text
        return $this->ajax()->text('text');
        // Output: text
    }

    public fucntion statusTestAction()
    {
        return $this->ajax()->status('ok', 'Ok message');
        // Output : {"status" : "ok", "message" : "Ok message"}

        return $this->ajax()->status('ok', 'Ok message', array('data' => 'Returns data'));
        // Output : {"status" : "ok", "message" : "Ok message", "data" => "Retruns data"}

        return $this->ajax()->status('ok', array('data' => 'Returns data'));
        // Output : {"status" : "ok", "data" => "Retruns data"}
    }

    public fucntion successTestAction()
    {
        return $this->ajax()->success(true, 'Ok message', array('data' => 'Returns data'));
        // output : {"success" : true, "message" : "Ok message", "data" => "Retruns data"}

        return $this->ajax()->success(false, 'False message');
        // Output : {"success" : false, "message" : "False message"}

        return $this->ajax()->success(true, array('data' => 'Returns data'));
        // Output : {"success" : true, "data" => "Retruns data"}
    }
```


## String library
```php
    echo \AtansCommon\Text\String::cut('This is a longer text', 6);
    // output : This i...
``
