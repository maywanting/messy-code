package SocialNetwork;
import java.util.*;
class Message {
    private int id;
    private String title;
    private String text;
    private ArrayList<Integer> readUsers;
    private ArrayList<Integer> likeUsers;

    Message(int id, String title, String text) {
        this.id = id;
        this.title = title;
        this.text = text;
        this.readUsers = new ArrayList<Integer>();
        this.likeUsers = new ArrayList<Integer>();
    }

    public boolean ifReadMsg(int userId) {
        return this.readUsers.contains(userId);
    }

    public boolean ifLikeMsg(int userId) {
        return this.likeUsers.contains(userId);
    }

    public void readMsg(int userId) {
        this.readUsers.add(userId);
    }

    public void likeMsg(int userId) {
        this.likeUsers.add(userId);
    }
    public int getLikeNum() {
        return this.likeUsers.size();
    }
    public String getMsg() {
        return "[" + this.id + "]" + this.title + ":" + this.text;
        // return "[" + this.id + "]like: [" + this.likeUsers.size() + "]" + this.likeUsers + "/ read: [" + this.readUsers.size() + "] " + this.readUsers;
    }
    public int getReadNum() {
        return this.readUsers.size();
    }
}

class User {
    private int id; //unique ID
    private String username; //username
    private ArrayList<Integer> msgIds; //all the messages that user posted
    private int likeNum; //numbers of users who likes the posted messages;

    User(int id, String name) {
        this.id = id;
        this.username = name;
        this.msgIds = new ArrayList<Integer>();
        this.likeNum = 0;
    }
    public void postMsg(int msgId) {
        this.msgIds.add(msgId);
    }

    public void updateLikeNum() {
        this.likeNum += 1;
    }

    public boolean ifPostMsg(int msgId) {
        return this.msgIds.contains(msgId);
    }

    public int getLikeNum() {
        return this.likeNum;
    }

    public String getUser() {
        return "[" + this.id + "]" + this.username;
    }
}

class Network {
    private ArrayList<User> userList;
    private ArrayList<Message> msgList;
    private User mostPopularUser;
    private Message mostLikedMsg;
    private Message mostReadMsg;

    Network () {
        this.userList = new ArrayList<User>();
        this.msgList = new ArrayList<Message>();
        this.mostPopularUser = new User(0, "none");
        this.mostLikedMsg = new Message(0, "none", "none");
        this.mostReadMsg = new Message(0, "none", "none");
    }
    public void createUser() {
        int id = this.userList.size();
        // System.out.println("user" + id);
        User newUser = new User(id, "user" + id);
        userList.add(newUser);
        this.updateSituation();
    }

    protected void updateSituation() {
        if (this.userList.size() != 0) {
            //update mostPopularUser
            for (User i:this.userList) {
                if (i.getLikeNum() > this.mostPopularUser.getLikeNum()) {
                    this.mostPopularUser = i;
                }
            }
        }

        if (this.msgList.size() != 0) {
            //update most read message & most like message
            for (Message i : this.msgList) {
                if (i.getLikeNum() > this.mostReadMsg.getLikeNum()) {
                    this.mostLikedMsg = i;
                }
                if (i.getReadNum() > this.mostReadMsg.getReadNum()) {
                    this.mostReadMsg = i;
                }
            }
            // System.out.println(this.mostReadMsg.getMsg());
        }
    }

    //report the situation
    public void displaySituation() {
        System.out.println("----------------");
        System.out.println("Number of users: " + userList.size());
        System.out.println("Number of Message: " + msgList.size());
        if (this.mostPopularUser.getLikeNum() > 0) {
            System.out.println("Most pupular user: " + this.mostPopularUser.getUser());
        } else {
            System.out.println("Most pupular user: Nobody");
        }
        if (this.mostReadMsg.getReadNum() > 0) {
            System.out.println("Most read message: " + this.mostReadMsg.getMsg());
        } else {
            System.out.println("Most read message: No such mesage");
        }
        if (this.mostLikedMsg.getLikeNum() > 0) {
            System.out.println("Most popular message: " + this.mostLikedMsg.getMsg());
        } else {
            System.out.println("Most popular message: No such mesage");
        }
    }

    public int getMsgNum() {
        return this.msgList.size();
    }

    public boolean userPostMsg(int userId) {
        if (userId >= this.userList.size()) {
            return false;
        } else {
            int id = this.msgList.size();
            Message newMsg = new Message(id , "title" + id, "text" + id);
            this.msgList.add(newMsg);
            User user = this.userList.get(userId);
            user.postMsg(id);
            this.updateSituation();
            return true;
        }
    }

    public boolean userReadMsg(int userId, int msgId) {
        User user = this.userList.get(userId);
        Message msg = this.msgList.get(msgId);
        if (user.ifPostMsg(msgId)) {
            return false;
        } else if (msg.ifReadMsg(userId)) {
            return true;
        } else {
            msg.readMsg(userId);
            this.updateSituation();
            this.displaySituation();
            return true;
        }
    }

    public boolean userLikeMsg(int userId, int msgId) {
        User user = this.userList.get(userId);
        Message msg = this.msgList.get(msgId);

        if (msg.ifLikeMsg(userId)) {
            return false;
        } else {
            msg.likeMsg(userId);
            user.updateLikeNum();
            this.updateSituation();
            this.displaySituation();
            return true;
        }
    }
}

class Main {
    public static void main(String[] args) {
        Network network = new Network();

        //create 4users
        for (int i = 0; i < 4; i++) {
            network.createUser();
            // network.displaySituation();
        }
        //post messages
        for (int i = 0; i < 20; i++) {
            int uid = (int)(Math.random()*4);
            network.userPostMsg(uid);
            // network.displaySituation();
        }
        System.out.println("============post over============");

        //read and like messages
        int msgNum = network.getMsgNum();
        for (int i = 0; i < 40; i++) {
            int uid = (int)(Math.random()*4);
            int msgId = (int)(Math.random()*msgNum);
            if (network.userReadMsg(uid, msgId) && ((int)(Math.random()*2) == 1)) {
                network.userLikeMsg(uid, msgId);
            }
        }

    }
}
