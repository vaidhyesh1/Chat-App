package com.example.admin.firebase;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;

import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;

public class Main2Activity extends AppCompatActivity {


    DatabaseReference databaseReference;
    TextView name;
    TextView email;
    TextView phone;
    String id;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main2);

        databaseReference= FirebaseDatabase.getInstance().getReference("Details");
        //DatabaseReference ref = databaseReference.child(id);
        id=getIntent().getStringExtra("id");
        name=findViewById(R.id.editText);
        email=findViewById(R.id.editText2);
        phone=findViewById(R.id.editText3);
    }

    public void updated(View v){
       Details details=new Details(email.getText().toString(),name.getText().toString(),Integer.parseInt(phone.getText().toString()),id,null);
        databaseReference.child(id).setValue(details);
        Intent i=new Intent(this,MainActivity.class);
        startActivity(i);
    }
}
