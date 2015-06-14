/**
 * Created by dengyonghui on 15/6/11.
 */

$.get("B6.php",{"m":"credit", "a":"getCreditInfo"} , function(data)
{
    // 如果后边别的组没有接口的话：
    // 步骤:
    // 1. 通过student_id,查询呢student_course.得到所有我获得学分的课程course_class_id。
    // 2. course_class_id 查询course_class，获得Course_id
    // 3. Course_id  查询course，得到到type，credit。
    // 4. 最后进行统计，返回数据

    console.log(data);
    creditList = [];
    creditList = JSON.parse(data);
/*
    var nameList = [ "通识课程", "大类课程", "专业课程", "第二课堂",
                "专业必修课程", "专业选修课程", "本专业模块课程", "跨专业模块", "通识思政类", "通识军体类"];

    creditList = [];
    for(var i = 0; i < nameList.length; i++)
    {
        var credit = new Credit();
        credit.name = nameList[i];
        credit.standard = Math.floor(Math.random()*20 + 1);
        credit.actualCredits = Math.floor(Math.random()*credit.standard + 1);
        creditList.push(credit);
    }
    */



    totalCreditClass = creditList.length;
    totalPage = Math.ceil((totalCreditClass - 1) / 4);
    showPage = 0;

    renderCreditData();
});