import { motion } from "framer-motion";
import { Mail, Github, Linkedin, MessageCircle } from "lucide-react";
import SectionHeading from "@/components/atoms/SectionHeading";
import { siteConfig, contactContent } from "@/data/content";

const contactLinks = [
  {
    icon: Mail,
    label: "Email",
    value: siteConfig.email,
    href: `mailto:${siteConfig.email}`,
  },
  {
    icon: Github,
    label: "GitHub",
    value: "@alexchen",
    href: siteConfig.github,
  },
  {
    icon: Linkedin,
    label: "LinkedIn",
    value: "Alex Chen",
    href: siteConfig.linkedin,
  },
];

const ContactSection = () => {
  return (
    <section className="py-24 bg-background">
      <div className="container mx-auto px-6">
        <div className="max-w-2xl mx-auto text-center">
          <SectionHeading
            title={contactContent.heading}
            subtitle={contactContent.subheading}
            align="center"
          />

          {/* Availability Status */}
          <motion.div
            className="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary/10 text-primary mb-12"
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
          >
            <span className="w-2 h-2 rounded-full bg-primary animate-pulse" />
            <span className="text-sm font-medium">{contactContent.availabilityStatus}</span>
          </motion.div>

          {/* Contact Links */}
          <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mb-12">
            {contactLinks.map((link, index) => (
              <motion.a
                key={link.label}
                href={link.href}
                target={link.label !== "Email" ? "_blank" : undefined}
                rel={link.label !== "Email" ? "noopener noreferrer" : undefined}
                className="group p-6 rounded-2xl bg-card border border-border hover:border-primary/30 transition-all"
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ delay: index * 0.1 }}
                whileHover={{ y: -4 }}
              >
                <link.icon className="w-6 h-6 text-muted-foreground group-hover:text-primary transition-colors mx-auto mb-3" />
                <p className="text-sm text-muted-foreground mb-1">{link.label}</p>
                <p className="text-foreground font-medium group-hover:text-primary transition-colors">
                  {link.value}
                </p>
              </motion.a>
            ))}
          </div>

          {/* CTA */}
          <motion.a
            href={`mailto:${siteConfig.email}`}
            className="inline-flex items-center gap-2 px-8 py-4 bg-primary text-primary-foreground font-medium rounded-full hover:shadow-lg transition-shadow"
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            whileHover={{ scale: 1.02 }}
            whileTap={{ scale: 0.98 }}
          >
            <MessageCircle size={20} />
            {contactContent.cta}
          </motion.a>
        </div>
      </div>
    </section>
  );
};

export default ContactSection;
