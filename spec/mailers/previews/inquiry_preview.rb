# Preview all emails at http://localhost:3000/rails/mailers/inquiry
class InquiryPreview < ActionMailer::Preview

  # Preview this email at http://localhost:3000/rails/mailers/inquiry/received_email
  def received_email
    InquiryMailer.received_email
  end

end
