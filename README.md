AtansCommon
===========
The Atans library

Ajax contoller plugin
---------------------
```php
    public function textAction()
    {
        // Text
        return $this->ajax()->text('text');
        // output: text
    }

    public fucntion statusTestAction()
    {
        return $this->ajax()->status('ok', 'Ok message');
        // output : {"status" : "ok", "message" : "Ok message"}

        // OR
        return $this->ajax()->status('ok', 'Ok message', array('data' => 'Returns data'));
        // output : {"status" : "ok", "message" : "Ok message", "data" => "Retruns data"}

        OR
        return $this->ajax()->status('ok', array('data' => 'Returns data'));
        // output : {"status" : "ok", "data" => "Retruns data"}
    }

    public fucntion successTestAction()
    {
        return $this->ajax()->success(true, 'Ok message', array('data' => 'Returns data'));
        // output : {"success" : true, "message" : "Ok message", "data" => "Retruns data"}

        return $this->ajax()->success(false, 'False message');
        // output : {"success" : false, "message" : "False message"}

        return $this->ajax()->success(true, array('data' => 'Returns data'));
        // output : {"success" : true, "data" => "Retruns data"}
    }
```
