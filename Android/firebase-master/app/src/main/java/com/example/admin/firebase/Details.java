package com.example.admin.firebase;



public class Details {

    String email;
    String name;
    long phone_number;
    String id;
    public class address{
        String dno;
        String first_line;
        String second_line;
        String city;
        String state;
        int zip;

        public String getDno() {
            return dno;
        }

        public void setDno(String dno) {
            this.dno = dno;
        }

        public String getFirst_line() {
            return first_line;
        }

        public void setFirst_line(String first_line) {
            this.first_line = first_line;
        }

        public String getSecond_line() {
            return second_line;
        }

        public void setSecond_line(String second_line) {
            this.second_line = second_line;
        }

        public String getCity() {
            return city;
        }

        public void setCity(String city) {
            this.city = city;
        }

        public String getState() {
            return state;
        }

        public void setState(String state) {
            this.state = state;
        }

        public int getZip() {
            return zip;
        }

        public void setZip(int zip) {
            this.zip = zip;
        }
    }
    address a;

    public Details(String email, String name, long phone_number, String id, address a) {
        this.email = email;
        this.name = name;
        this.phone_number = phone_number;
        this.id = id;
        this.a = a;
    }

    public String getEmail() {
        return email;
    }

    public String getName() {
        return name;
    }

    public long getPhone_number() {
        return phone_number;
    }

    public String getId() {
        return id;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public void setName(String name) {
        this.name = name;
    }

    public void setPhone_number(long phone_number) {
        this.phone_number = phone_number;
    }

    public void setId(String id) {
        this.id = id;
    }

    public address getA() {
        return a;
    }

    public void setA(address a) {
        this.a = a;
    }
}
