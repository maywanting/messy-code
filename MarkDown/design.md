- A圆圈为前端的显示
- C圆方块为接口，接口部分还有一个getComboContent，其余的全部都已经使用了
- B方块为文本缓存
- D菱形为getData脚本

```chart
graph TD
    A-->B;
    B-->C;
```


```chart
graph LR
    A1((问财投顾))-->C1(getTougouInfo);
    C1-->B1["d/{stock}/tougu.txt"];
    A2((技术面分析))-->C2(getTechnology);

    C2 -->B2["d/{stock}/technology.txt"];
    C2 -->B3["d/{query}.txt"];
    A3((资金面分析)) -->A4((个股今日资金));

    A3 -->A5((行业今日资金));
    A3 -->A6((资金流向));
    A4 -->C3(getSelfFund);
    A5 -->C4(getIndusFund);
    A6 -->C5(getFund);

    C5 -->B6["d/{s}/fund_origin.txt"];
    C3 -->B4["d/{s}/self_fund.txt"];
    C4 -->B5["d/{s}/indus_fund.txt"];

    A7((基金面分析)) -->C6(op=getBasic);
    C6 -->B7["d/{s}/{query}rankresult.txt"];
    C5 -->B8["d/{s}/{query}self.txt"];
    C5 -->B9["d/{s}/{query}average.txt"];

    A8((消息面分析)) -->C7(op=getMessageList);
    A8 -->A9((详细消息));
    A9 -->C8(op=getMessageDetail);
    C6 -->B10["d/{s}/message.txt"];
    C8 -->B10;

    B11["d/xlabel_{market}/.txt"]-- 1 -->D1{getData行情数据处理};

    C9(quote:A股大单5分K)-- 2 --> D1;
    D1-- 3 -->B12["d/{s}/dde.txt"];
    D1-- 3 -->B13["d/{s}/dde{x}.txt"];
    D1-- 4 -->B14["d/stocklist{x}.txt"];
    C10(quote:市场5分K)-- 5 --> D1;
    D1-- 6 -->B15["d/{s}/ddemarket.txt"];
    D1-- 6 -->B16["d/{s}/ddemarket{x}.txt"];
    C11(quote:A股日线)-- 7 --> D1;
    D1-- 8 -->B17["d/{s}/ddeall.txt"];
    D1-- 8 -->B18["d/{s}/ddeall{x}.txt"];
    C12(quote:市场日线)-- 9 --> D1;
    D1-- 10 -->B19["d/{s}/ddemarketall.txt"];
    D1-- 10 -->B20["d/{s}/ddemarketall{x}.txt"];
    B21["d/jyr.txt"]-- 11 -->D1;

    D1-- 下一步循环体内 -->D2{getData每只股票数据处理};
    B22["d/{s}/induscode.txt"]-- 12 -->D2;
    B23["d/{s}/indus.txt"]-- 13 -->D2;

    D2-- 调用 -->D3{getRealTimeFund};
    B12-- 14 -->D3;
    B15-- 15 -->D3;
    B4-- 16 -->D3;
    B5-- 17 -->D3;
    B17-- 18 -->D3;
    B19-- 19 -->D3;
    D3-- 20 -->B4;
    D3-- 21 -->B5;
    D3-- 22 -->B24["d/{s}/self_fundall.txt"];
    D3-- 23 -->B25["d/{s}/indus_fundall.txt"];

    D3 -- 调用 -->D4{getFundDes};
    B17 -- 24 -->D4;
    D4-- 25 -->B26["d/{s}/self_fund_des.txt"];

    D3 -- 调用 -->D5{getIndusFundDes};
    D5 -- 26 -->B27["d/{s}/indus_fund_des.txt"];

    B28["d/{s}/info_content.txt"]-- 27 -->D2;
    B26-- 28 -->D2;
    B23-- 29 -->D2;
    D2-- 30 -->B29["d/{s}/info_title.txt"];
    B26 -- 31 -->D2;
    B27-- 32 -->D2;
    D2-- 33 -->B30["d/{s}/fund_title.txt"];
    D2-- 34 -->B6;
    D2-- 35 -->B31["d/{s}/fund_title_origin.txt"];
    B32["d/{s}/message_title.txt"]-- 36 -->D2;
    B29 -- 37 -->D2;
    B37["d/{s}/technology_title.txt"] -- 38 -->D2;
    B30 -- 39 -->D2;
    B33["d/{s}/basic_title.txt"]-- 40 -->D2;
    B34["d/{s}/tougu_title.txt"]-- 41 -->D2;
    D2-- 42 -->B35["d/{s}/combo.json"];

    D1-- 43 -->B11;
    D1-- 调用 -->D6{nodeJs};

    B14-- 44 -->D6;
    B35-- 45 -->D6;
    D6-- 46 -->B36["产品html"];
```
