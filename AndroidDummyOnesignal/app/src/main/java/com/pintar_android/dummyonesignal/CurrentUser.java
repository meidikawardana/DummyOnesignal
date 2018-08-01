package com.pintar_android.dummyonesignal;

/**
 * class ini untuk menampung data user yang sedang login saat ini
 */
public class CurrentUser {
    private int id; //variabel untuk menyimpan id user
    private String username; //variabel untuk menyimpan username
    private String name; //variabel untuk menyimpan nama user
    private String oneSignalUserId;

    //fungsi ini dijalankan pertama kali ketika class ini dibuat / dipakai. harus ada supaya aplikasi tidak error
    public CurrentUser() {
    }

    //fungsi ini untuk menyimpan data user
    public CurrentUser(int id, String username, String name, String oneSignalUserId) {
        this.id = id; //simpan id user
        this.username = username; //simpan username
        this.name = name; //simpan nama
        this.oneSignalUserId = oneSignalUserId;
    }

    //fungsi ini untuk mendapatkan id user
    public int getId() {
        return id;
    }

    //fungsi ini untuk mendapatkan username
    public String getUsername() {
        return username;
    }

    //fungsi ini untuk mendapatkan nama
    public String getName() {
        return name;
    }

    public String getOneSignalUserId() {
        return oneSignalUserId;
    }

    public void setOneSignalUserId(String oneSignalUserId) {
        this.oneSignalUserId = oneSignalUserId;
    }
}
