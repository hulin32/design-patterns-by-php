---
title: 第二十七章 其实你不懂老板的心 －－－ 解释器模式
type: docs
weight: 28
---

### 第二十七章 其实你不懂老板的心 －－－ 解释器模式

```php
<?php

interface AbstractExpression
{
    public function interpret(Context $context);
}

class TerminalExpression implements AbstractExpression
{
    public function interpret(Context $context)
    {
        echo "终端解释器\n";
    }
}

class NonTerminalExpression implements AbstractExpression
{
    public function interpret(Context $context)
    {
        echo "非终端解释器\n";
    }
}

class Context
{
    private $input;
    public function setInput($input)
    {
        $this->input = $input;
    }

    public function getInput()
    {
        return $this->input;
    }

    private $output;
    public function setOutput($output)
    {
        $this->output = $output;
    }

    public function getOutput()
    {
        return $this->output;
    }
}


$context = new Context();
$syntax = [];
array_push($syntax, new TerminalExpression());
array_push($syntax, new NonTerminalExpression());
array_push($syntax, new TerminalExpression());
array_push($syntax, new TerminalExpression());

foreach ($syntax as $value) {
    $value->interpret($context);
}
```

> ***解释器模式***，给定一个语言，定义它的文法的一种表示，并定义一个解释器，这个解释器使用该表示来解释语言的句子。

> 如果一种特定语言类型的问题发生的频率足够高，那么可能就值得将该问题的各个实例表述为一个简单语言的句子。这样就可以构建一个解释器，该解释器通过解释这些句子来解决该问题。

> 通常当有一个语言需要解释执行，并且你可将该语言的句子表示为一个抽象语法树时，可使用解释器模式。

> 解释器模式容易修改和扩展文法，因为解释器模式使用类来表示文法规则，你可使用继承来改变或扩展该文法。也比较容易实现文法，因为定义抽象语法树中各个节点的类的实现大体类似，这些类都易于直接编写。

> 解释器模式不足的是要为文法中的每一条规则至少定义了一个类，因此包含许多规则的文法可能难以管理和维护。建议当文法非常复杂时，使用其他的技术如语法分析程序或编译器生成器来处理。

上一章：[第二十六章 项目多也别傻做 －－－ 享元模式]({{< relref "/docs/chapter26" >}})

下一章：[第二十八章 男人和女人 －－－ 访问者模式]({{< relref "/docs/chapter28" >}})