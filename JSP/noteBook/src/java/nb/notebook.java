/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package nb;

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import java.sql.*;
import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
/**
 *
 * @author WangTing
 */
public class notebook extends HttpServlet {

    Connection con;
    PrintWriter out;
    ResultSet rs;
    
    public void init() {
        con = null;
        out = null;
        rs = null;
    }
    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet notebook</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>Servlet notebook at " + request.getContextPath() + "</h1>");
            out.println("</body>");
            out.println("</html>");
        }
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        //processRequest(request, response);
        doPost(request, response);
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        //processRequest(request, response);     
        try {
            out = response.getWriter();
            Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
            con = DriverManager.getConnection("jdbc:odbc:notebook", "sa", "hello");
            PreparedStatement pstmt = null;
            String query = null;
            query = "select * from note";
            pstmt = con.prepareStatement(query);
            rs = pstmt.executeQuery();
         
            int count = 0;
            try {
                while (rs.next()) {
                    count = count +1;
                }
            } catch (SQLException e1) {
                e1.printStackTrace();
            }
            
            out.println(count);
            out.println(request.getParameter("context"));
            if (count == 0) {
                query = "insert into note(content) values (?)";
            } else {
                query = "update note set content=?";
                
            }
            pstmt.close();
            pstmt = con.prepareStatement(query);
            pstmt.setString(1, request.getParameter("context"));
            pstmt.executeUpdate();
            out.println("fuck");
        } catch (Exception e) {
            e.printStackTrace();
        }
        response.sendRedirect("notebook.jsp");
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>
    
    @Override
    public void destroy() {
        /*try {
            con.close();
            out.close();
            rs.close();
        } catch (SQLException se) {
            out.println(se.toString());
        }*/
    }
}
