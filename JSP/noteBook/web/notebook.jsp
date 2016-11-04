<%-- 
    Document   : notebook
    Created on : 2016-6-5, 19:13:28
    Author     : WangTing
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page language="java" import="java.sql.*"%>
<%
    Connection con = null;
    Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
            
    con = DriverManager.getConnection("jdbc:odbc:notebook", "sa", "hello");
    PreparedStatement pstmt = null;
    String query = null;
    query = "select * from note";
    pstmt = con.prepareStatement(query);
    ResultSet rs = pstmt.executeQuery();
    String content = "";
    while(rs.next()) {
        content = rs.getString("content");
    }
%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <form method="post" action="http://localhost:8084/notebook/notebook">
            <textarea name="context">
                <%=content%>
            </textarea>
            <button type="submit">save</button>
        </form>
    </body>
</html>

<%
    rs.close();
    con.close();
%>
    
