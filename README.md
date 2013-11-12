## AtansCommon

Master: [![Build Status](https://secure.travis-ci.org/atans/AtansCommon.png?branch=master)](http://travis-ci.org/atans/AtansCommon)

The Atans library

- 0.1.1 (4/8/2013)

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
```

## View widget

### Flash messenger Alert

Controller:

```php
    public function indexAction()
    {
        $this->flashMessenger()
             ->setNamespace('application-index')
             ->addSuccessMessage('Message text');

        ...

        return array();
    }
```

View:

```php
    //application/index/index.phtml
    <?php echo $this->render('alert/bootstrap', array('namespace' => 'application-index')) ?>
    ...
```

Html output:

```html
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      message text
    </div>
    ...
```

### Boostrap navbar


```php
    // application/layout/layout.phtml
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
            ...
            <div class="collapse navbar-collapse">
                <?php echo $this->navigation('navigation')->menu()->setPartial(array('navigation/bootstrap', 'default'))->render() ?>
            </div>
        </div>
    </nav>
```

### Bootstrap pagination

php

```php
    // user/user/index.phtml
    <?php
    if (count($this->paginator)) {
        echo $this->paginationControl(
            $this->paginator,
            'Sliding',
            'pagination/query',
            array(
                'route' => 'user',
                'options' => array(
                    'query' => array(
                        'keyword' => $keyword,
                    ),
                ),
            )
        );
    }
    ?>
```

html output:

```html
<ul class="pagination">
  <li class="disabled"><a href="#">&laquo;</a></li>
  <li><a href="/user?page=1&keyword=test">1</a></li>
  <li><a href="/user?page=2&keyword=test">2</a></li>
  <li><a href="/user?page=3&keyword=test">3</a></li>
  <li><a href="/user?page=2&keyword=test">&raquo;</a></li>
</ul>

```




