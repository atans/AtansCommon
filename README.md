## AtansCommon

Master: [![Build Status](https://secure.travis-ci.org/atans/AtansCommon.png?branch=master)](http://travis-ci.org/atans/AtansCommon)

The Atans library

- 0.1.0 (18/7/2013)

## Ajax contoller plugin
```php
    public function textAction()
    {
        // Text
        return $this->ajax()->html('<strong>html</strong>');
        // Content-Type: text/html
        // Output: <strong>html</strong>
    }

    public function textAction()
    {
        // Text
        return $this->ajax()->text('text');
        // Content-Type: text/plain
        // Output: text
    }

    public fucntion statusTestAction()
    {
        return $this->ajax()->status('ok', 'Ok message');
        // Content-Type: application/json
        // Output : {"status" : "ok", "message" : "Ok message"}

        return $this->ajax()->status('ok', 'Ok message', array('data' => 'Returns data'));
        // Output : {"status" : "ok", "message" : "Ok message", "data" => "Retruns data"}

        return $this->ajax()->status('ok', array('data' => 'Returns data'));
        // Output : {"status" : "ok", "data" => "Retruns data"}
    }

    public fucntion successTestAction()
    {
        return $this->ajax()->success(true, 'Ok message', array('data' => 'Returns data'));
        // Content-Type: application/json
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
