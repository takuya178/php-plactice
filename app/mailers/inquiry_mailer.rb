class InquiryMailer < ApplicationMailer
  def send_mail(inquiry)
    @inquiry = inquiry
    mail(to: @inquiry.email, subject: "お問合せ内容")
  end
end
