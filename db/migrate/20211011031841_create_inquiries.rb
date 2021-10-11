class CreateInquiries < ActiveRecord::Migration[6.0]
  def change
    create_table :inquiries do |t|
      t.text :message
      t.string :name
      t.string :email

      t.timestamps
    end
  end
end
