FactoryBot.define do
  factory :user do
    name { Faker::Name.name  }
    sequence(:email) { |n| "sample#{n}@example.com" }
    password { '1234567' }
    password_confirmation { '1234567' }
  end

  trait :admin do
    name { Faker::Name.name }
    role { :admin }
  end
end
