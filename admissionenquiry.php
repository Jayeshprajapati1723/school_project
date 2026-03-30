<!-- admission enquiry form  -->
<section class="enquiry-section" style="padding: 50px 8%; background: #fff;">
    <div style="max-width: 600px; margin: auto; padding: 30px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border: 1px solid #e1e8ed;">
        <h2 style="text-align: center; color: #1a2a6c; margin-bottom: 20px;">Admission Enquiry form</h2>
        <p style="text-align: center; color: #666; margin-bottom: 25px;">Interested in admission? Fill these details and we will call you!</p>
        
        <form action="save_enquiry.php" method="POST">
            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Parent Name</label>
                <input type="text" name="p_name" style="width: 100%; padding: 12px; border: 2px solid #e1e8ed; border-radius: 8px;" required>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Student Name</label>
                <input type="text" name="s_name" style="width: 100%; padding: 12px; border: 2px solid #e1e8ed; border-radius: 8px;" required>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Mobile Number</label>
                <input type="text" name="mobile" maxlength="10" style="width: 100%; padding: 12px; border: 2px solid #e1e8ed; border-radius: 8px;" required>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="font-weight: 600; display: block; margin-bottom: 5px;">Class Interested In</label>
                <select name="class" style="width: 100%; padding: 12px; border: 2px solid #e1e8ed; border-radius: 8px;">
                    <option>Play Group</option>
                    <option>Nursery</option>
                    <option>LKG / UKG</option>
                    <option >1st</option>
                                        <option>1st</option>
                    <option>2nd</option>
                    <option>3rd</option>
                    <option>4th</option>
                    <option>5th</option>
                    <option>6th</option>
                    <option>7th</option>
                    <option>8th</option>
                </select>
            </div>
            <button type="submit" style="width: 100%; padding: 15px; background: #2575fc; color: white; border: none; border-radius: 10px; font-weight: 700; cursor: pointer;">Send Enquiry</button>
        </form>
    </div>
</section>
