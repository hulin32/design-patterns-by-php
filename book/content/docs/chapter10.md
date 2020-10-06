---
title: 第十章 考题抄错会做也白搭 －－－ 模版方法模式
type: docs
weight: 11
---

### 第十章 考题抄错会做也白搭 －－－ 模版方法模式
```php
<?php 
// 对甲乙两名同学所抄试卷，尽量将相同的部分提到父类
// 金庸小说考题试卷
class TestPaper
{
    public function TestQuestion1()
    {
        echo "杨过说过，后来给了郭靖，炼成倚天剑、屠龙刀的玄铁可能是［］a.球磨铸铁 b.马口铁 c.高速合金钢 d.碳素纤维 \n";
        echo "答案 ".$this->answer1()."\n";
    }

    public function TestQuestion2()
    {
        echo "杨过、程英、陆无双铲除了情花，造成［］a.使这种植物不在害人 b.使一种珍惜物种灭绝 c.破坏了那个生态圈的生态平衡 d.造成该地区沙漠化 \n";
        echo "答案 ".$this->answer2()."\n";
    }

    public function TestQuestion3()
    {
        echo "蓝凤凰致使华山师徒、桃谷六仙呕吐不止，如果你是大夫，会给他们开什么药［］a.阿司匹林 b.牛黄解毒片 c.氟哌酸 d.让他们喝大量的生牛奶 e.以上全不对 \n";
        echo "答案 ".$this->answer3()."\n";
    }

    protected function answer1()
    {
        return '';
    }

    protected function answer2()
    {
        return '';
    }

    protected function answer3()
    {
        return '';
    }
}

// 学生甲抄的试卷
class TestPaperA extends TestPaper
{
    protected function answer1()
    {
        return 'a';
    }

    protected function answer2()
    {
        return 'b';
    }

    protected function answer3()
    {
        return 'c';
    } 
}

// 学生乙抄的试卷
// 学生甲抄的试卷
class TestPaperB extends TestPaper
{
    protected function answer1()
    {
        return 'd';
    }

    protected function answer2()
    {
        return 'c';
    }

    protected function answer3()
    {
        return 'a';
    } 
}


// 客户端代码

echo "学生甲抄的试卷: \n";
$student = new TestPaperA();
$student->TestQuestion1();
$student->TestQuestion2();
$student->TestQuestion3();
echo "学生乙抄的试卷: \n";
$student2 = new TestPaperB();
$student2->TestQuestion1();
$student2->TestQuestion2();
$student2->TestQuestion3();
```

总结：

> ***模版方法模式***，定义一个操作中的算法的骨架，而将一些步骤延迟到子类中。模版方法使得子类可以不改变算法的节结构即可重定义该算法的某些特定步骤。

> 既然用了继承，并且肯定这个继承有意义，就应该要成为子类的模版，所有重复的代码都应该要上升到父类去，而不是让每个子类去重复。

> 当我们要完成在某一细节层次一致的一个过程或一系列步骤，但其中个别步骤在更详细的层次上的实现可能不同时，我们通常考虑用模版方法模式来处理。

> 模版方法模式是通过把不变行为搬移到超类，去除子类中的重复代码来体现它的优势。提供了一个很好的代码复用平台。

> 当不变的和可变的行为在方法的子类实现中混合在一起的时候，不变的行为就会在子类中重复出现。通过模版方法把这些行为搬移到单一的地方，这样就帮助子类摆脱重复的不变行为的纠缠。

上一章：[第九章 简历复印 －－－ 原型模式]({{< relref "/docs/chapter9" >}})

下一章：[第十一章 无熟人难办事 －－－ 迪米特法则]({{< relref "/docs/chapter11" >}})