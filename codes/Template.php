<?php 

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



















